<?php namespace App\Models;
 
use CodeIgniter\Model;
use CodeIgniter\Database\RawSql;
 
class AbsenModel extends Model{
    protected $table = 'absensi';
    protected $primaryKey = 'absen_id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['user_id', 'tanggal', 'clockin', 'clockout', 'foto','foto_out','tipe','latitude','longtitude','latitude_out','longtitude_out', 'çreated_at', 'updated_at'];

    public function search($tgl, $nama, $kelas){
        $builder = $this->table('absensi');
        $builder->join('users','users.user_id=absensi.user_id');
        $builder->join('siswa','siswa.siswa_nis=users.user_nik');
        $builder->join('kelas','kelas.kelas_id=siswa.kelas_id');
        $builder->like('absensi.tanggal', $tgl);
        $builder->like('siswa.siswa_nama', $nama);
        $builder->like('kelas.kelas', $kelas);


        return $builder;
    }
    public function search2( $nama, $kelas, $bulan){
        $sql = "siswa.siswa_nis, siswa.siswa_nama, kelas.kelas, users.user_id, min(absensi.tanggal) as tanggal_awal, max(absensi.tanggal) as tanggal_akhir, 
        SUM(CASE
        WHEN absensi.tipe = 1 THEN 1
        ELSE 0
        END) AS hadir,
        SUM(CASE
        WHEN absensi.tipe = 2 THEN 1
        ELSE 0
        END) AS sakit,
        SUM(CASE
        WHEN absensi.tipe = 3 THEN 1
        ELSE 0
        END) AS izin,
        SUM(CASE
        WHEN absensi.tipe = 0 THEN 1
        ELSE 0
        END) AS tanpa_keterangan";
        $builder = $this->table('absensi');
        $builder->select(new RawSql($sql) );

        $builder->join('users','users.user_id=absensi.user_id');
        $builder->join('siswa','siswa.siswa_nis=users.user_nik');
        $builder->join('kelas','kelas.kelas_id=siswa.kelas_id');
        $builder->like('siswa.siswa_nama', $nama);
        
        $builder->like('kelas.kelas', $kelas); 
        $builder->like('absensi.tanggal', $bulan, 'after');


        return $builder;
    }

    public function search3($nama, $kelas, $bulan){
        $sql = "users.user_id, absensi.tipe, absensi.tanggal";
        $builder = $this->table('absensi');
        $builder->select(new RawSql($sql) );
        $builder->join('users','users.user_id=absensi.user_id');
        $builder->join('siswa','siswa.siswa_nis=users.user_nik');
        $builder->join('kelas','kelas.kelas_id=siswa.kelas_id');
        $builder->like('siswa.siswa_nama', $nama);

        $builder->like('kelas.kelas', $kelas);
       $builder->like('absensi.tanggal', $bulan, 'after');

        return $builder;
    }
}