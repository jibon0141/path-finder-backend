<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;
use App\Service\Report\StudentReport;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Utility\Log;
use Mail;  

class TestCronJob extends Command
{

    protected $signature = 'process:test_signature {--isEmailSend=} {--group_id=}';


    protected $description = 'test signature description';
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
    $search['is_email_send']=!empty($this->option('isEmailSend')) ? 1 : 0;
    $search['group_id']=!empty($this->option('group_id')) ? $this->option('group_id') : 0;
    $studentReportObj=new StudentReport();
   ($studentReportObj->generateReport($search));
    }
}