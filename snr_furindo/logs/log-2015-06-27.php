ERROR - 27-06-2015 04:25:52 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:25:53 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:26:11 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:26:13 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:26:13 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:26:13 --> select id_timesheet as IDTimesheet, 
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
                                                  
                                                  and (tanggal >= '2015-06-27' and tanggal <= '2015-06-27')   
                                                  order by Tanggal, NamaProyek, KodeProsedur asc 
ERROR - 27-06-2015 04:26:33 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:26:34 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:26:35 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:26:40 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:26:47 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:26:48 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:26:50 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:26:50 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:27:07 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:30:27 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:31:15 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:31:25 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:31:26 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:31:27 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:31:44 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:33:12 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:33:17 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:33:18 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:34:35 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:34:36 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:34:43 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:34:44 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:34:44 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:34:53 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:34:54 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:34:55 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:35:36 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:36:55 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:37:01 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:37:08 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:37:09 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:37:09 --> Severity: Notice  --> Undefined offset: 2 D:\xampp\htdocs\timesheet\timesheet_application\helpers\func_helper.php 128
ERROR - 27-06-2015 04:37:09 --> Severity: Notice  --> Undefined offset: 1 D:\xampp\htdocs\timesheet\timesheet_application\helpers\func_helper.php 129
ERROR - 27-06-2015 04:37:09 --> Severity: Notice  --> Undefined offset: 2 D:\xampp\htdocs\timesheet\timesheet_application\helpers\func_helper.php 128
ERROR - 27-06-2015 04:37:09 --> Severity: Notice  --> Undefined offset: 1 D:\xampp\htdocs\timesheet\timesheet_application\helpers\func_helper.php 129
ERROR - 27-06-2015 04:37:13 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:37:14 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:37:15 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:39:01 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:39:38 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:39:39 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:39:40 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:39:43 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:39:48 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:39:56 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:40:00 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:40:00 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:40:06 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:40:06 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:40:06 --> Severity: Notice  --> Undefined offset: 2 D:\xampp\htdocs\timesheet\timesheet_application\helpers\func_helper.php 128
ERROR - 27-06-2015 04:40:06 --> Severity: Notice  --> Undefined offset: 1 D:\xampp\htdocs\timesheet\timesheet_application\helpers\func_helper.php 129
ERROR - 27-06-2015 04:40:06 --> Severity: Notice  --> Undefined offset: 2 D:\xampp\htdocs\timesheet\timesheet_application\helpers\func_helper.php 128
ERROR - 27-06-2015 04:40:06 --> Severity: Notice  --> Undefined offset: 1 D:\xampp\htdocs\timesheet\timesheet_application\helpers\func_helper.php 129
ERROR - 27-06-2015 04:40:48 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:40:49 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:40:50 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:40:53 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:40:55 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:40:55 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:41:04 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:41:05 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:41:06 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:41:08 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:41:09 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:41:09 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:41:19 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:41:26 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:41:32 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:41:34 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:41:35 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:42:38 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:42:39 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:42:40 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:42:44 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:42:49 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:42:57 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:42:57 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:43:10 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:43:12 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:43:18 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:43:21 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:43:21 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:43:26 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:43:27 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:44:20 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:44:21 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:44:21 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:44:44 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:44:49 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:44:50 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:44:52 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:45:52 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:45:54 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:45:54 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:45:58 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:46:16 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:46:17 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:46:18 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:46:33 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:46:34 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:46:35 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:46:48 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:46:50 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:46:51 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:47:24 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 04:47:28 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 05:02:48 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 05:02:51 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 05:02:53 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
ERROR - 27-06-2015 05:02:57 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead D:\xampp\htdocs\timesheet\system\database\drivers\mysql\mysql_driver.php 91
