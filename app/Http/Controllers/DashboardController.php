<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class DashboardController extends Controller
{
    public function index()
    {
        $data['diterima'] = Pengaduan::where("id_status", 1)->get()->count();
        $data['dikirim'] = Pengaduan::where("id_status", 2)->get()->count();
        $data['dijawab'] = Pengaduan::where("id_status", 3)->get()->count();
        $data['instansi'] = Instansi::withCount('pengaduan')->get();
        return view('HomeDashboard', $data);
    }

    public function pengaduan()
    {
        $data['instansi'] = Instansi::all();
        return view('formPengaduan', $data);
    }

    // public function inputaduan(Request $req)
    // {
    //     $image = $req['ttd'];
    //     $image = str_replace('data:image/png;base64,', '', $image);
    //     $image = str_replace(' ', '+', $image);
    //     $imageName = 'ttd' . date("YmdHis") . '.' . 'png';

    //     $cred = $req->validate([
    //         'nama' => 'required',
    //         'nohp' => 'required',
    //         'alamat' => 'required',
    //         'isi_aduan' => 'required'
    //     ]);

    //     $data['tgl_aduan'] = date('Y-m-d');
    //     $data['nama'] = $cred['nama'];
    //     $data['id_instansi'] = $req['instansi'];
    //     $data['id_status'] = 1;
    //     $data['alamat'] = $cred['alamat'];
    //     $data['telepon'] = $cred['nohp'];
    //     $data['aduan'] = $cred['isi_aduan'];
    //     $data['penginput'] = 'mandiri';
    //     $data['nama_file'] = $imageName;

    //     Pengaduan::create($data);
    //     Storage::disk('local')->put('public/doc/' . $imageName, base64_decode($image));

    //     return redirect('/form-pengaduan');
    // }

    public function getDataAduan($id)
    {
        $data = Pengaduan::where('id', $id)->with('instansi')->first();
        $data['list_instansi'] = Instansi::all();
        return response()->json($data);
    }

    public function teruskanAduan(Request $req)
    {
        $data_pengaduan = Pengaduan::where('id', $req['data_id_aduan'])->with('instansi')->first();

        $data_instansi = Instansi::where('id', $req['data_instansi'])->first();
        $emails = [];
        if ($data_instansi->email1) {
            $emails[] = $data_instansi->email1;
        }
        if ($data_instansi->email2) {
            $emails[] = $data_instansi->email2;
        }
        if ($data_instansi->email3) {
            $emails[] = $data_instansi->email3;
        }

        if ($data_pengaduan['is_aduan'] == 1) {
            $msg = "Institusi Anda mendapatkan aduan layanan melalui Sistem TEMAN BAIK, harap cek E-Mail Anda untuk melihat dan menjawab aduan tersebut";
            $data_pengaduan['subject'] = 'Pengaduan Layanan';
        } else {
            $msg = "Institusi Anda mendapatkan pemohonan informasi melalui Sistem TEMAN BAIK, harap cek E-Mail Anda untuk melihat dan menjawab permohonan tersebut";
            $data_pengaduan['subject'] = 'Permohonan Informasi Layanan';
        }

        if ($data_pengaduan->penginput == 'admin') {
            $data_pengaduan['penginput'] = "Admin";
        } else {
            $data_pengaduan['penginput'] = "Form Pengaduan Mandiri";
        }

        if ($data_pengaduan['nama_file_eviden']) {
            $evidensrc = 'eviden/' . $data_pengaduan['nama_file_eviden'];
            $data_pengaduan['bukti_dukung'] = '<a href="' . asset($evidensrc) . '">Lampiran Bukti</a>';
        } else {
            $data_pengaduan['bukti_dukung'] = '';
        }

        $imgsrc = 'doc/' . $data_pengaduan['nama_file'];
        if ($data_pengaduan['samarkan'] == 0) {
            if ($data_pengaduan['penginput'] == 'Admin') {
                $data_pengaduan['ttd'] = '<a href="' . asset($imgsrc) . '"><img src="' . asset($imgsrc) . '" alt="Kertas Pengaduan" width="70%"></a>';
            } else {
                $data_pengaduan['ttd'] = '<img src="' . asset($imgsrc) . '" alt="Tanda Tangan" width="350px">';
            }
        } else {
            $data_pengaduan['nama'] = "";
            $data_pengaduan['ttd'] = "Pemohon";
        }

        if (count($emails) > 1) {
            Mail::to($emails[0])->cc(array_slice($emails, 1))->send(new SendMail($data_pengaduan));
        } else {
            Mail::to($emails[0])->send(new SendMail($data_pengaduan));
        }

        if ($data_pengaduan['id_status'] == 1) {
            Pengaduan::where('id', $req['data_id_aduan'])->update([
                'id_instansi' => $req['data_instansi'],
                'id_status' => 2
            ]);
        }

        if ($data_instansi->no_wa1) {
            $warespon = json_decode($this->sendWaToIns($data_instansi['no_wa1'], $msg));
        } else {
            $warespon = [];
        }

        return redirect('/pengaduan')->with('success', $warespon);
    }

    public function sendWaToIns($nohp, $msg)
    {
        $token = env("WA_TOKEN", null);
        $instance_id = env("WA_ID", null);
        $msgsend = urlencode($msg);
        $jid = "62" . substr($nohp, 1) . "@s.whatsapp.net";
        $url = "https://app.multichat.id/api/v1/send-text?token=" . $token . "&instance_id=" . $instance_id . "&jid=" . $jid . "&msg=" . $msgsend;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $respon = curl_exec($ch);

        curl_close($ch);

        return $respon;
    }

    public function exportData()
    {
        $logs = Pengaduan::with(['instansi', 'status'])->orderBy('tgl_aduan', 'asc')->get();
        $filename = "data_pengaduan.csv";

        return response()->streamDownload(function () use ($logs) {
            $csv = fopen("php://output", "w+");

            fputcsv($csv, ["tgl_aduan", "jenis_permohonan", "penginput", "instansi_tujuan", "status", "samarkan_identitas", "nama",  "alamat", "telepon", "isi_permohonan", "jawaban", "ttd", "bukti_dukung"], ';');

            foreach ($logs as $log) {
                $log->is_aduan == 1 ? $jenis_permohonan = 'pengaduan' : $jenis_permohonan = 'informasi';
                $log->samarkan == 1 ? $samarkan = 'ya' : $samarkan = 'tidak';
                $ttd = env("ASSET_URL", "/storage") . '/doc/' . $log->nama_file;
                if ($log->nama_file_eviden) {
                    $eviden = env("ASSET_URL", "/storage") . '/eviden/' . $log->nama_file_eviden;
                } else {
                    $eviden = NULL;
                }
                fputcsv($csv, [
                    $log->tgl_aduan,
                    $jenis_permohonan,
                    $log->penginput,
                    $log->instansi->nama_instansi,
                    $log->status->status,
                    $samarkan,
                    $log->nama,
                    $log->alamat,
                    $log->telepon,
                    $log->aduan,
                    $log->jawaban,
                    $ttd,
                    $eviden
                ], ';');
            }

            fclose($csv);
        }, $filename, ["Content-type" => "text/csv"]);
    }
}
