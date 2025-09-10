<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Http\Requests\StorePengaduanRequest;
use App\Http\Requests\UpdatePengaduanRequest;
use App\Models\Instansi;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('store');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['instansi'] = Instansi::all();
        $data['aduan'] = Pengaduan::with(['instansi', 'status'])->orderBy('tgl_aduan', 'asc')->paginate(5);
        return view('pengaduan', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePengaduanRequest $request)
    {


        if ($request['penginput'] == 'admin') {
            $cred = $request->validate([
                'tgl_aduan' => 'required',
                'instansi' => 'required',
                'nama' => 'required',
                'nohp' => 'required',
                'alamat' => 'required',
                'isi_aduan' => 'required',
                'bukti' => 'nullable|mimes:jpeg,png,pdf|file|max:3072',
                'kertas' => 'required|image|file|max:3072'
            ]);

            $imageName = 'form_' . date("YmdHis") . '.' . $request->file('kertas')->getClientOriginalExtension();
            if ($request->file('bukti')) {
                $eviden = 'evid_' . date("YmdHis") . '.' . $request->file('bukti')->getClientOriginalExtension();
                $data['nama_file_eviden'] = $eviden;
            } else {
                $data['nama_file_eviden'] = '';
            }


            $data['tgl_aduan'] = $request['tgl_aduan'];
            $data['nama'] = strip_tags($cred['nama']);
            $data['id_instansi'] = $request['instansi'];
            $data['id_status'] = 1;
            $data['is_aduan'] = $request['jenisAduan'];
            $data['alamat'] = strip_tags($cred['alamat']);
            $data['telepon'] = $cred['nohp'];
            $data['aduan'] = strip_tags($cred['isi_aduan']);
            $data['penginput'] = $request['penginput'];
            $data['nama_file'] = $imageName;
            if ($request['samarkan']) {
                $data['samarkan'] = $request['samarkan'];
            } else {
                $data['samarkan'] = 0;
            }

            Pengaduan::create($data);
            Storage::disk('local')->put('public/doc/' . $imageName, file_get_contents($request->file('kertas')));
            if ($request->file('bukti')) {
                Storage::disk('local')->put('public/eviden/' . $eviden, file_get_contents($request->file('bukti')));
            }

            //--------------------------------------kirim wa ke pemohon----------------------------//

            $msgsend = urlencode("Terima kasih telah menghubungi TEMAN BAIK, Setiap Aduan/Pertanyaan/Saran anda akan kami teruskan ke Instansi/BUMN/BUMD yang terkait");

            $jid = "62" . substr($data['telepon'], 1) . "@s.whatsapp.net";

            $this->sendWA($jid, $msgsend);

            //--------------------------------------------------------------------------------------//

            return redirect('/pengaduan')->with('success', 'Permohonan Berhasil di Input');
        } else if ($request['penginput'] == 'mandiri') {
            $turnstile_secret     = '0x4AAAAAAAx-ewNeLhbUv8dWxisoCD94j-4';
            $turnstile_response   = $_POST['cf-turnstile-response'];
            $url                  = "https://challenges.cloudflare.com/turnstile/v0/siteverify";
            $post_fields          = "secret=$turnstile_secret&response=$turnstile_response";

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
            $response = curl_exec($ch);
            curl_close($ch);

            $response_data = json_decode($response);

            if ($response_data->success) {
                $image = $request['ttd'];
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = 'ttd_' . date("YmdHis") . '.' . 'png';

                $cred = $request->validate([
                    'nama' => 'required',
                    'nohp' => 'required',
                    'alamat' => 'required',
                    'isi_aduan' => 'required',
                    'bukti' => 'mimes:jpeg,png,pdf|file|max:3072'
                ]);

                if ($request->file('bukti')) {
                    $eviden = 'evid_' . date("YmdHis") . '.' . $request->file('bukti')->getClientOriginalExtension();
                    $data['nama_file_eviden'] = $eviden;
                } else {
                    $data['nama_file_eviden'] = '';
                }

                $data['tgl_aduan'] = date('Y-m-d');
                $data['nama'] = strip_tags($cred['nama']);
                $data['id_instansi'] = $request['instansi'];
                $data['id_status'] = 1;
                $data['is_aduan'] = $request['jenisAduan'];
                $data['alamat'] = strip_tags($cred['alamat']);
                $data['telepon'] = $cred['nohp'];
                $data['aduan'] = strip_tags($cred['isi_aduan']);
                $data['penginput'] = 'mandiri';
                $data['nama_file'] = $imageName;
                if ($request['samarkan']) {
                    $data['samarkan'] = $request['samarkan'];
                } else {
                    $data['samarkan'] = 0;
                }

                Pengaduan::create($data);
                Storage::disk('local')->put('public/doc/' . $imageName, base64_decode($image));
                if ($request->file('bukti')) {
                    Storage::disk('local')->put('public/eviden/' . $eviden, file_get_contents($request->file('bukti')));
                }

                if ($request['jenisAduan'] == 1) {
                    $msg = "Pengaduan baru masuk, harap cek pada aplikasi TEMAN BAIK";
                } else {
                    $msg = "Permohonan Informasi baru masuk, harap cek pada aplikasi TEMAN BAIK";
                }

                $msgsend = urlencode($msg);

                $jid = env("WA_ADMIN", "6285248443705") . "@s.whatsapp.net";

                $this->sendWA($jid, $msgsend);

                //--------------------------------------kirim wa ke pemohon----------------------------//

                $msgsend = urlencode("Terima kasih telah menghubungi TEMAN BAIK, Setiap Aduan/Pertanyaan/Saran anda akan kami teruskan ke Instansi/BUMN/BUMD yang terkait");

                $jid = "62" . substr($data['telepon'], 1) . "@s.whatsapp.net";

                $this->sendWA($jid, $msgsend);

                //--------------------------------------------------------------------------------------//

                return redirect('/form')->with('success', 'Permohonan Berhasil Dikirim');
            } else {
                return redirect('/form')->with('success', 'Permohonan Gagal Dikirim');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePengaduanRequest $request, Pengaduan $pengaduan)
    {
        //
        Pengaduan::where('id', $pengaduan->id)->update([
            'jawaban' => $request->jawaban,
            'id_status' => 3
        ]);

        $msg = "Terima Kasih sudah menghubungi TEMAN BAIK (TEMpat penyampaiAN Berbagai Aduan di mal pelayanan publIK).\n\nBerdasarkan Permohonan ";
        if ($pengaduan->is_aduan) {
            $msg .= "Pengaduan ";
        } else {
            $msg .= "Informasi ";
        }
        $msg .= "yang Bapak/Ibu " . strtoupper($pengaduan->nama) . " sampaikan pada tanggal " . date_format(date_create($pengaduan->tgl_aduan), "d/m/Y") . " ke Instansi " . $pengaduan->instansi->nama_instansi . ",\n\n";
        $msg .= "Dapat kami sampaikan sebagai berikut :\n";
        $msg .= $request->jawaban;

        $msgsend = urlencode($msg);

        $jid = "62" . substr($pengaduan->telepon, 1) . "@s.whatsapp.net";

        $respon = $this->sendWA($jid, $msgsend);

        return $respon;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengaduan $pengaduan)
    {
        //
    }

    public function sendWA($jid, $msg)
    {
        $token = env("WA_TOKEN", null);
        $instance_id = env("WA_ID", null);
        $url = "https://app.multichat.id/api/v1/send-text?token=" . $token . "&instance_id=" . $instance_id . "&jid=" . $jid . "&msg=" . $msg;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $respon = curl_exec($ch);

        curl_close($ch);

        return $respon;
    }
}
