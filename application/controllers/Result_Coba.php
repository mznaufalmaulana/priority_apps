<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Result_Coba extends CI_Controller
{

    public function index()
    {
        $id_proyek = 'PA20190505122111';
        $this->db->select('id_kebutuhan');
        $this->db->from('data_kebutuhan');
        $this->db->where('id_proyek', $id_proyek);
        $data_acak = $this->db->get()->result();
        print_r($data_acak);
        // die;

        $waktu_awal = time();

        $result = array();
        for ($i = 0; $i < 5; $i++) {
            $hasil = $this->get_kromosom($data_acak, $id_proyek);
            array_push($result, $hasil);
        }
        $result = array(
            0 => array(0 => 'R1-R5-R4-R3-R2-', 1 => 6),
            1 => array(0 => 'R2-R3-R5-R4-R1-', 1 => 5),
            2 => array(0 => 'R3-R2-R1-R5-R4-', 1 => 4),
            3 => array(0 => 'R5-R4-R2-R1-R3-', 1 => 8),
            4 => array(0 => 'R2-R5-R1-R4-R3-', 1 => 5)
        );

        echo '<br>';
        // echo '<pre>';
        print_r($result);
        // echo '</pre>';
        die;

        for ($i = 0; $i < 2000; $i++) {
            if (time() - $waktu_awal > 300) {
                $data['prioritas'] = $result[0][0];
                echo "waktu habis";
                die;
            } else if ($result[0][1] == 0) {
                $data['prioritas'] = $result[0][0];
                echo '<br>';
                echo 'Pada perulangan = ' . $i . ' dengan formasi urutan = ' . $result[0][0];
                die;
            } else if ($i == 2000) {
                echo '<br> <br> Perhitungan Tidak Dijalankan';
                die;
            }
            $angka = $this->random($result);
            $mutasi = $this->mutasi($result[$angka], $id_proyek);
            $angka = $this->random($result);
            $mutasi2 = $this->mutasi($result[$angka], $id_proyek);
            $angka = $this->random($result);
            $mutasi3 = $this->mutasi($result[$angka], $id_proyek);
            $angka = $this->random($result);
            $mutasi4 = $this->mutasi($result[$angka], $id_proyek);

            echo '<br>';
            echo 'Mutasi 1 = ';
            print_r($mutasi);
            echo '<br>';
            echo '<br>';
            echo 'Mutasi 2 = ';
            print_r($mutasi2);
            echo '<br>';
            echo '<br>';
            echo 'Mutasi 3 = ';
            print_r($mutasi3);
            echo '<br>';
            echo '<br>';
            echo 'Mutasi 4 = ';
            print_r($mutasi4);
            echo '<br>';
            echo '<br>';

            $indeks1 = $this->random($result);
            $indeks2 = $this->random($result);
            while ($indeks1 == $indeks2) {
                $indeks2 = $this->random($result);
            }
            $crossover1 = $this->crossover($result[$indeks1], $result[$indeks2], $id_proyek);
            $crossover2 = $this->crossover($result[$indeks2], $result[$indeks1], $id_proyek);

            echo 'Crossover 1 = ';
            print_r($crossover1);
            echo '<br>';
            echo '<br>';
            echo 'Crossover 2 = ';
            print_r($crossover2);
            echo '<br>';
            echo '<br>';

            array_push($result, $mutasi);
            array_push($result, $mutasi2);
            array_push($result, $mutasi3);
            array_push($result, $mutasi4);
            array_push($result, $crossover1);
            array_push($result, $crossover2);


            $result = $this->sort($result, $data_acak, $id_proyek);
            echo 'Perulangan Ke-' . ($i + 1) . '<br>';
            print_r($result);
            echo '<br>';
            // echo '<br>';
        }
    }
    private function get_kromosom($data, $id_proyek)
    {
        $kromosom = $this->kromosom($data);
        $disagreement = $this->cek_disagreement($kromosom, $id_proyek);

        $result = array(
            $kromosom, $disagreement,
        );

        return $result;
    }
    private function random($data)
    {
        $angka = rand(0, count($data) - 2);
        return $angka;
    }
    private function kromosom($data_acak)
    {
        $hasil = '';
        shuffle($data_acak);
        foreach ($data_acak as $val) {
            $hasil .= $val->id_kebutuhan . '-';
        }
        return $hasil;
    }
    private function cek_disagreement($kromosom, $id_proyek)
    {
        $disagree = 0;
        $data = explode('-', $kromosom);
        for ($i = 0; $i < count($data) - 1; $i++) {
            for ($j = $i; $j < count($data) - 1; $j++) {
                if ($data[$i] != $data[$j]) {
                    $cek = $data[$i] . '-' . $data[$j];
                } else {
                    continue;
                }
                $hasil = $this->db->get_where('data_voting', ['id_proyek' => $id_proyek, 'id_jarak' => $cek])->row_array();
                if ($hasil['status'] == -1) {
                    $disagree += 1;
                }
            }
        }
        return $disagree;
    }
    private function mutasi($data, $id_proyek)
    {
        $kromosom = explode('-', $data[0]);
        $indeks1 = $this->random($kromosom);
        $indeks2 = $this->random($kromosom);

        while ($indeks1 == $indeks2) {
            $indeks2 = $this->random($kromosom);
        }
        $kromosom_baru = $kromosom;

        $kromosom_baru[$indeks1] = $kromosom[$indeks2];
        $kromosom_baru[$indeks2] = $kromosom[$indeks1];

        $hasil = '';
        for ($i = 0; $i < count($kromosom_baru) - 1; $i++) {
            $hasil .= $kromosom_baru[$i] . '-';
        }

        $disagreement = $this->cek_disagreement($hasil, $id_proyek);

        $result = array($hasil, $disagreement);
        return $result;
    }
    private function crossover($data1, $data2, $id_proyek)
    {
        $head = (count($data1) / 2) - 1;
        $ganti = $head;
        $kromosom1 = explode('-', $data1[0]);
        $kromosom2 = explode('-', $data2[0]);
        $kromosom_baru = $kromosom1;

        for ($i = 0; $i < count($kromosom2) - 1; $i++) {
            for ($j = $head; $j < count($kromosom_baru); $j++) {
                if ($kromosom1[$j] == $kromosom2[$i]) {
                    $kromosom_baru[$ganti] = $kromosom2[$i];
                    $ganti++;
                }
            }
        }

        $hasil = '';
        for ($i = 0; $i < count($kromosom_baru) - 1; $i++) {
            $hasil .= $kromosom_baru[$i] . '-';
        }

        $disagreement = $this->cek_disagreement($hasil, $id_proyek);

        $result = array($hasil, $disagreement);
        return $result;

        // return $kromosom_baru;
    }
    private function sort($data, $data_acak, $id_proyek)
    {
        $temp = 0;
        $result = array();

        for ($i = 0; $i < count($data); $i++) {
            for ($j = $i; $j < count($data); $j++) {
                if ($data[$i][1] > $data[$j][1]) {
                    $temp = $data[$i][1];
                    $data[$i][1] = $data[$j][1];
                    $data[$j][1] = $temp;

                    $temp = $data[$i][0];
                    $data[$i][0] = $data[$j][0];
                    $data[$j][0] = $temp;
                }
            }
        }
        $result = array_slice($data, 0, 5, true);
        return $result;
    }
}
