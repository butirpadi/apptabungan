<?php

namespace App\Controllers\Transaksi;

class BayarController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return \View::make('transaksi.bayar.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $tapelAktif = \App\Models\Tapel::whereAktif('Y')->first();
        $siswa = \App\Models\Siswa::find(\Input::get('idsiswa'));
        // echo $siswa->rombels()->where('tahunajaran_id',5)->first()->nama;
        return \View::make('transaksi.bayar.debet', array(
            'siswa' => $siswa,
            'tapelAktif' => $tapelAktif
            ));


        // Cara Terbaru tapi belum Fix
        // $siswa = \DB::table('view_siswa')->find(\Input::get('idsiswa'));
        // $transaksi = \DB::table('tab_transaksi')->where('siswa_id','=',\Input::get('idsiswa'))->get();
        // return \View::make('transaksi.bayar.debet', [
        //         'siswa' => $siswa,
        //         'transaksi' => $transaksi,
        //     ]);
        // ============================
    }

    public function debet($siswaid) {
        $siswa = \App\Models\Siswa::find($siswaid);
        $tapelAktif = \App\Models\Tapel::whereAktif('Y')->first();
        return \View::make('transaksi.bayar.debet', 
            array(
                'siswa' => $siswa, 
                'berhasil' => 'true',
                'tapelAktif' => $tapelAktif,
            ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $trans = new \App\Models\Transaksi();
        $trans->tgl = date('Y-m-d', strtotime(\Input::get('tgl')));
        $trans->siswa_id = \Input::get('siswaid');
        $trans->jenis = 'D';
        $jumlah = \Input::get('jumlah');
        $jumlah = str_replace('Rp', '', $jumlah);
        $jumlah = str_replace('.', '', $jumlah);

        //cek data double
        //get last trans
        $time = date('Y-m-d H:i:s');
        $siswa = \App\Models\Siswa::find(\Input::get('siswaid'));
        $lastTrans = $siswa->transaksi()->orderBy('created_at', 'desc')->first();

        echo 'pocess input...';

        if ($lastTrans) {
            //cek selisih antara last trans dengan transaksi baru
            //harus lebih dari 10 detik...
            //
            $data = \DB::select("select ((HOUR(TIMEDIFF('" . $time . "','" . $lastTrans->created_at . "'))*360)+(MINUTE(TIMEDIFF('" . $time . "','" . $lastTrans->created_at . "')) *60)+ SECOND(TIMEDIFF('" . $time . "','" . $lastTrans->created_at . "'))) as selisih  from dual");
            $selisih = ($data ? $data[0]->selisih : 0);
            echo $selisih;
            ////////////
            if ($selisih > 10) {
                if ($jumlah > 0) {
                    $trans->jumlah = $jumlah;
                    $trans->save();
                    //cek saldo
                    $saldo = \App\Models\Saldo::whereSiswaId(\Input::get('siswaid'))->first();
                    if ($saldo == null) {
                        $saldo = new \App\Models\Saldo();
                        $saldo->siswa_id = \Input::get('siswaid');
                        $saldo->saldo = 0;
                        $saldo->save();
                    }
                    //update saldo
                    $dbt = $siswa->transaksi()->where('jenis', 'D')->sum('jumlah');
                    $kdt = $siswa->transaksi()->where('jenis', 'K')->sum('jumlah');
                    $saldo->saldo = $dbt - $kdt;
                    $saldo->save();
                }
            }
        } else {
            //input data pertama karena tidak ada last trans
            if ($jumlah > 0) {
                $trans->jumlah = $jumlah;
                $trans->save();
                //cek saldo
                $saldo = \App\Models\Saldo::whereSiswaId(\Input::get('siswaid'))->first();
                if ($saldo == null) {
                    $saldo = new \App\Models\Saldo();
                    $saldo->siswa_id = \Input::get('siswaid');
                    $saldo->saldo = 0;
                    $saldo->save();
                }
                //update saldo
                $dbt = $siswa->transaksi()->where('jenis', 'D')->sum('jumlah');
                $kdt = $siswa->transaksi()->where('jenis', 'K')->sum('jumlah');
                $saldo->saldo = $dbt - $kdt;
                $saldo->save();
            }
        }

        return \Redirect::to('transaksi/bayar/debet/' . $trans->siswa_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        return \View::make('transaksi.bayar.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
