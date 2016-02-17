ERROR - 26-06-2015 11:42:28 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:42:30 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:42:33 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:42:33 --> select id_timesheet as IDTimesheet, 
                                                  trxProyek.id_program as IDProgram, 
                                                  trxProgramKerja.id_proyek as IDProyek, 
                                                  trxProgramKerja.id_prosedur as IDProsedur,
                                                  trxTimesheet.id_indikator as IDIndikator, 
                                                  trxTimesheet.id_kunjungan as IDKunjungan,
                                                  trxTimesheet.id_sub_output as IDSubOutput,
                                                  trxProgramKerja.id_output as IDOutput,
                                                  nama_proyek as NamaProyek, 
                                                  nama_program as NamaProgram,
                                                  nama_client as NamaClient,
                                                  nama_kunjungan as NamaKunjungan,
                                                  nama_indikator as NamaIndikator,
                                                  kode_prosedur as KodeProsedur, 
                                                  (select nama_output from trx_output trxOutput where trxOutput.id_output = 
                                                  (select id_output from trx_program_kerja where id_proyek = trxProgramKerja.id_proyek limit 1) ) as NamaOutput,
                                                  (select nama_divisi from ref_divisi where id_divisi = trxProyek.id_divisi) as NamaDivisi,
                                                  aktivitas as Aktivitas, jam as Waktu, tanggal as Tanggal, jam as Waktu,    
                                                  trxTimesheet.id_program_kerja as IDProgramKerja 

                                                  from trx_timesheet trxTimesheet 
                                                  left join trx_program_kerja trxProgramKerja on trxProgramKerja.id_program_kerja = trxTimesheet.id_program_kerja     
                                                  left join trx_proyek trxProyek on trxProyek.id_proyek = trxProgramKerja.id_proyek
                                                  left join ref_prosedur refProsedur on refProsedur.id_prosedur = trxProgramKerja.id_prosedur 
                                                  left join mst_program mstProgram on mstProgram.id_program = trxProyek.id_program 
                                                  left join mst_client mstClient on mstClient.id_client = trxProyek.id_client 
                                                  left join ref_kunjungan refKunjungan on refKunjungan.id_kunjungan = trxTimesheet.id_kunjungan 
                                                  left join ref_indikator refIndikator on refIndikator.id_indikator = trxTimesheet.id_indikator 

                                                  where trxTimesheet.id_karyawan = '5' 
                                                  -- and month(tanggal) = '06' and year(tanggal) = '2015'  
                                                  and (tanggal >= '2015-20-10' and tanggal <= '2015-10-10')   
                                                  order by Tanggal, NamaProyek, KodeProsedur asc 
ERROR - 26-06-2015 11:42:45 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:42:46 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:43:02 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:43:02 --> select id_timesheet as IDTimesheet, 
                                                  trxProyek.id_program as IDProgram, 
                                                  trxProgramKerja.id_proyek as IDProyek, 
                                                  trxProgramKerja.id_prosedur as IDProsedur,
                                                  trxTimesheet.id_indikator as IDIndikator, 
                                                  trxTimesheet.id_kunjungan as IDKunjungan,
                                                  trxTimesheet.id_sub_output as IDSubOutput,
                                                  trxProgramKerja.id_output as IDOutput,
                                                  nama_proyek as NamaProyek, 
                                                  nama_program as NamaProgram,
                                                  nama_client as NamaClient,
                                                  nama_kunjungan as NamaKunjungan,
                                                  nama_indikator as NamaIndikator,
                                                  kode_prosedur as KodeProsedur, 
                                                  (select nama_output from trx_output trxOutput where trxOutput.id_output = 
                                                  (select id_output from trx_program_kerja where id_proyek = trxProgramKerja.id_proyek limit 1) ) as NamaOutput,
                                                  (select nama_divisi from ref_divisi where id_divisi = trxProyek.id_divisi) as NamaDivisi,
                                                  aktivitas as Aktivitas, jam as Waktu, tanggal as Tanggal, jam as Waktu,    
                                                  trxTimesheet.id_program_kerja as IDProgramKerja 

                                                  from trx_timesheet trxTimesheet 
                                                  left join trx_program_kerja trxProgramKerja on trxProgramKerja.id_program_kerja = trxTimesheet.id_program_kerja     
                                                  left join trx_proyek trxProyek on trxProyek.id_proyek = trxProgramKerja.id_proyek
                                                  left join ref_prosedur refProsedur on refProsedur.id_prosedur = trxProgramKerja.id_prosedur 
                                                  left join mst_program mstProgram on mstProgram.id_program = trxProyek.id_program 
                                                  left join mst_client mstClient on mstClient.id_client = trxProyek.id_client 
                                                  left join ref_kunjungan refKunjungan on refKunjungan.id_kunjungan = trxTimesheet.id_kunjungan 
                                                  left join ref_indikator refIndikator on refIndikator.id_indikator = trxTimesheet.id_indikator 

                                                  where trxTimesheet.id_karyawan = '5' 
                                                  -- and month(tanggal) = '06' and year(tanggal) = '2015'  
                                                  and (tanggal >= '2015-20-10' and tanggal <= '2015-10-10')   
                                                  order by Tanggal, NamaProyek, KodeProsedur asc 
ERROR - 26-06-2015 11:43:03 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:43:04 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:43:06 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:43:06 --> Severity: Warning  --> Missing argument 1 for Timesheet::GetDaftarTimesheet() D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 367
ERROR - 26-06-2015 11:43:06 --> Severity: Warning  --> Missing argument 2 for Timesheet::GetDaftarTimesheet() D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 367
ERROR - 26-06-2015 11:43:07 --> Severity: Notice  --> Undefined variable: tglAwal D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 374
ERROR - 26-06-2015 11:43:07 --> Severity: Notice  --> Undefined variable: tglAkhir D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 374
ERROR - 26-06-2015 11:43:07 --> select id_timesheet as IDTimesheet, 
                                                  trxProyek.id_program as IDProgram, 
                                                  trxProgramKerja.id_proyek as IDProyek, 
                                                  trxProgramKerja.id_prosedur as IDProsedur,
                                                  trxTimesheet.id_indikator as IDIndikator, 
                                                  trxTimesheet.id_kunjungan as IDKunjungan,
                                                  trxTimesheet.id_sub_output as IDSubOutput,
                                                  trxProgramKerja.id_output as IDOutput,
                                                  nama_proyek as NamaProyek, 
                                                  nama_program as NamaProgram,
                                                  nama_client as NamaClient,
                                                  nama_kunjungan as NamaKunjungan,
                                                  nama_indikator as NamaIndikator,
                                                  kode_prosedur as KodeProsedur, 
                                                  (select nama_output from trx_output trxOutput where trxOutput.id_output = 
                                                  (select id_output from trx_program_kerja where id_proyek = trxProgramKerja.id_proyek limit 1) ) as NamaOutput,
                                                  (select nama_divisi from ref_divisi where id_divisi = trxProyek.id_divisi) as NamaDivisi,
                                                  aktivitas as Aktivitas, jam as Waktu, tanggal as Tanggal, jam as Waktu,    
                                                  trxTimesheet.id_program_kerja as IDProgramKerja 

                                                  from trx_timesheet trxTimesheet 
                                                  left join trx_program_kerja trxProgramKerja on trxProgramKerja.id_program_kerja = trxTimesheet.id_program_kerja     
                                                  left join trx_proyek trxProyek on trxProyek.id_proyek = trxProgramKerja.id_proyek
                                                  left join ref_prosedur refProsedur on refProsedur.id_prosedur = trxProgramKerja.id_prosedur 
                                                  left join mst_program mstProgram on mstProgram.id_program = trxProyek.id_program 
                                                  left join mst_client mstClient on mstClient.id_client = trxProyek.id_client 
                                                  left join ref_kunjungan refKunjungan on refKunjungan.id_kunjungan = trxTimesheet.id_kunjungan 
                                                  left join ref_indikator refIndikator on refIndikator.id_indikator = trxTimesheet.id_indikator 

                                                  where trxTimesheet.id_karyawan = '5' 
                                                  -- and month(tanggal) = '06' and year(tanggal) = '2015'  
                                                  and (tanggal >= '26-06-2015' and tanggal <= '26-06-2015')   
                                                  order by Tanggal, NamaProyek, KodeProsedur asc 
ERROR - 26-06-2015 11:43:55 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:43:56 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:43:57 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:43:57 --> Severity: Warning  --> Missing argument 1 for Timesheet::GetDaftarTimesheet() D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 367
ERROR - 26-06-2015 11:43:57 --> Severity: Warning  --> Missing argument 2 for Timesheet::GetDaftarTimesheet() D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 367
ERROR - 26-06-2015 11:43:57 --> Severity: Notice  --> Undefined variable: tglAwal D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 374
ERROR - 26-06-2015 11:43:57 --> Severity: Notice  --> Undefined variable: tglAkhir D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 374
ERROR - 26-06-2015 11:43:57 --> select id_timesheet as IDTimesheet, 
                                                  trxProyek.id_program as IDProgram, 
                                                  trxProgramKerja.id_proyek as IDProyek, 
                                                  trxProgramKerja.id_prosedur as IDProsedur,
                                                  trxTimesheet.id_indikator as IDIndikator, 
                                                  trxTimesheet.id_kunjungan as IDKunjungan,
                                                  trxTimesheet.id_sub_output as IDSubOutput,
                                                  trxProgramKerja.id_output as IDOutput,
                                                  nama_proyek as NamaProyek, 
                                                  nama_program as NamaProgram,
                                                  nama_client as NamaClient,
                                                  nama_kunjungan as NamaKunjungan,
                                                  nama_indikator as NamaIndikator,
                                                  kode_prosedur as KodeProsedur, 
                                                  (select nama_output from trx_output trxOutput where trxOutput.id_output = 
                                                  (select id_output from trx_program_kerja where id_proyek = trxProgramKerja.id_proyek limit 1) ) as NamaOutput,
                                                  (select nama_divisi from ref_divisi where id_divisi = trxProyek.id_divisi) as NamaDivisi,
                                                  aktivitas as Aktivitas, jam as Waktu, tanggal as Tanggal, jam as Waktu,    
                                                  trxTimesheet.id_program_kerja as IDProgramKerja 

                                                  from trx_timesheet trxTimesheet 
                                                  left join trx_program_kerja trxProgramKerja on trxProgramKerja.id_program_kerja = trxTimesheet.id_program_kerja     
                                                  left join trx_proyek trxProyek on trxProyek.id_proyek = trxProgramKerja.id_proyek
                                                  left join ref_prosedur refProsedur on refProsedur.id_prosedur = trxProgramKerja.id_prosedur 
                                                  left join mst_program mstProgram on mstProgram.id_program = trxProyek.id_program 
                                                  left join mst_client mstClient on mstClient.id_client = trxProyek.id_client 
                                                  left join ref_kunjungan refKunjungan on refKunjungan.id_kunjungan = trxTimesheet.id_kunjungan 
                                                  left join ref_indikator refIndikator on refIndikator.id_indikator = trxTimesheet.id_indikator 

                                                  where trxTimesheet.id_karyawan = '5' 
                                                  -- and month(tanggal) = '06' and year(tanggal) = '2015'  
                                                  and (tanggal >= '2015-06-26' and tanggal <= '2015-06-26')   
                                                  order by Tanggal, NamaProyek, KodeProsedur asc 
ERROR - 26-06-2015 11:46:34 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:46:36 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:46:37 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:46:37 --> Severity: Warning  --> Missing argument 1 for Timesheet::GetDaftarTimesheet() D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 367
ERROR - 26-06-2015 11:46:37 --> Severity: Warning  --> Missing argument 2 for Timesheet::GetDaftarTimesheet() D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 367
ERROR - 26-06-2015 11:46:37 --> Severity: Notice  --> Undefined variable: tglAwal D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 374
ERROR - 26-06-2015 11:46:37 --> Severity: Notice  --> Undefined variable: tglAkhir D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 374
ERROR - 26-06-2015 11:46:53 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:47:03 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:47:05 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:47:05 --> Severity: Warning  --> Missing argument 1 for Timesheet::GetDaftarTimesheet() D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 367
ERROR - 26-06-2015 11:47:05 --> Severity: Warning  --> Missing argument 2 for Timesheet::GetDaftarTimesheet() D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 367
ERROR - 26-06-2015 11:47:05 --> Severity: Notice  --> Undefined variable: tglAwal D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 374
ERROR - 26-06-2015 11:47:05 --> Severity: Notice  --> Undefined variable: tglAkhir D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 374
ERROR - 26-06-2015 11:48:03 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:48:07 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:48:08 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:48:08 --> Severity: Warning  --> Missing argument 1 for Timesheet::GetDaftarTimesheet() D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 367
ERROR - 26-06-2015 11:48:08 --> Severity: Warning  --> Missing argument 2 for Timesheet::GetDaftarTimesheet() D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 367
ERROR - 26-06-2015 11:48:08 --> Severity: Notice  --> Undefined variable: tglAwal D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 374
ERROR - 26-06-2015 11:48:08 --> Severity: Notice  --> Undefined variable: tglAkhir D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 374
ERROR - 26-06-2015 11:50:05 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:50:10 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:50:29 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:50:38 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:50:41 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:50:42 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:50:42 --> Severity: Warning  --> Missing argument 1 for Timesheet::GetDaftarTimesheet() D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 367
ERROR - 26-06-2015 11:50:42 --> Severity: Warning  --> Missing argument 2 for Timesheet::GetDaftarTimesheet() D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 367
ERROR - 26-06-2015 11:50:42 --> Severity: Notice  --> Undefined variable: tglAwal D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 374
ERROR - 26-06-2015 11:50:42 --> Severity: Notice  --> Undefined variable: tglAkhir D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 374
ERROR - 26-06-2015 11:51:24 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:51:28 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:51:29 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:51:29 --> Severity: Warning  --> Missing argument 1 for Timesheet::GetDaftarTimesheet() D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 367
ERROR - 26-06-2015 11:51:29 --> Severity: Warning  --> Missing argument 2 for Timesheet::GetDaftarTimesheet() D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 367
ERROR - 26-06-2015 11:51:29 --> Severity: Notice  --> Undefined variable: tglAwal D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 374
ERROR - 26-06-2015 11:51:29 --> Severity: Notice  --> Undefined variable: tglAkhir D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 374
ERROR - 26-06-2015 11:51:35 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:51:37 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:51:38 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:51:38 --> Severity: Warning  --> Missing argument 1 for Timesheet::GetDaftarTimesheet() D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 367
ERROR - 26-06-2015 11:51:38 --> Severity: Warning  --> Missing argument 2 for Timesheet::GetDaftarTimesheet() D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 367
ERROR - 26-06-2015 11:51:38 --> Severity: Notice  --> Undefined variable: tglAwal D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 374
ERROR - 26-06-2015 11:51:38 --> Severity: Notice  --> Undefined variable: tglAkhir D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 374
ERROR - 26-06-2015 11:52:34 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:52:36 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:52:38 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 26-06-2015 11:52:38 --> Severity: Warning  --> Missing argument 1 for Timesheet::GetDaftarTimesheet() D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 367
ERROR - 26-06-2015 11:52:38 --> Severity: Warning  --> Missing argument 2 for Timesheet::GetDaftarTimesheet() D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 367
ERROR - 26-06-2015 11:52:38 --> Severity: Notice  --> Undefined variable: tglAwal D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 374
ERROR - 26-06-2015 11:52:38 --> Severity: Notice  --> Undefined variable: tglAkhir D:\xampp\htdocs\timesheet\timesheet_application\modules\timesheet\controllers\timesheet.php 374
