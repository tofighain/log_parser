<?php

namespace App\Console\Commands;

use App\Models\EndPoint;
use App\Models\Log;
use App\Models\Methode;
use App\Models\Protocol;
use App\Models\Service;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CliFileParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tofigh:parser {fileAddress=docs/logs.txt} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $baseUrl = 'http://192.168.1.114/bagloos/log_parser/';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $regex = '\s?([a-zA-Z0-9-]+)\s?\-\s?\[\s?(\d{1,2})\s?\/s?([a-zA-Z]{1,3})\s?\/s?(\d{4})\s?:([\d|:]+)\s?\]\s?\"(\w+)\s+([\/|\w+]+)\s+(\w+)\s?\/s?(\d+)\.s?(\d+)\"\s?(\d{1,3})\n?';
        $address = $this->baseUrl.$this->argument('fileAddress');
        
        $handle = fopen($address, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                // info array
                preg_match("/$regex/", $line, $output_array);
                $log = new Log();
                $output_array = array_slice($output_array, 1);
                $theDate=$output_array[3].'-'.$output_array[2].'-'.$output_array[1].' '.$output_array[4];
                $log->service_id = Service::where('slug', $output_array[0])->pluck('id')->toArray()[0];
                $log->output_date_time = date('Y-m-d H:i:s', strtotime($theDate));
                $log->method_id = Methode::where('slug', $output_array[5])->pluck('id')->toArray()[0];
                $log->protocol_id = Protocol::where('version', $output_array[8].'.'.$output_array[9])->pluck('id')->toArray()[0];
                $log->end_point_id = EndPoint::where('uri', $output_array[6])->pluck('id')->toArray()[0];
                $log->status_code = $output_array[10];
                $log->save();
                $this->info(implode("***",$output_array).PHP_EOL);
        }
    fclose($handle);
}
        

        return Command::SUCCESS;
    }
}
