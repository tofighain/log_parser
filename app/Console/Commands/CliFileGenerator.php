<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CliFileGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tofigh:generator {numberOfLines=1000}  {fileAddress=docs/logs.txt}';

    private $services = ['order-service', 'invoice-service'];
    private $endPoints = ['/orders', '/invoices'];
    private $methods = ['POST', 'GET', 'PUT', 'PATCH', 'DELETE'];
    private $start_date = '2023-01-01 00:00:00';
    private $end_date = '2024-01-01 00:00:00';

    private function randomDate()
    {
        // Convert to timetamps
        $min = strtotime($this->start_date);
        $max = strtotime($this->end_date);
    
        // Generate random number using above bounds
        $val = rand($min, $max);
    
        // Convert back to desired date format
        return date('d/M/Y:H:i:s', $val);
    }

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It generates random lines of input that simulates real data of bagloos challange 001';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $numOfLines = intval($this->argument('numberOfLines'));
        if($numOfLines < 1 ) $numOfLines = 1;
        if($numOfLines > 1000) $numOfLines = 1000;
        $address = base_path().'/'.$this->argument('fileAddress');
        $template = '%serviceName - [%date] "%method %endPoint HTTP/%vMain.%vSub" %status'.PHP_EOL;
        
        $serviceSize = count($this->services)-1;
        $methodSize = count($this->methods)-1;
        
        for ($i=0; $i < $numOfLines; $i++) { 
            $rand1 = rand(0,$serviceSize);
            $generated = [
                '%serviceName' => $this->services[$rand1],
                '%date' => $this->randomDate(),
                '%endPoint' => $this->endPoints[$rand1],
                '%method' => $this->methods[rand(0, $methodSize)],
                '%vMain' => rand(1,3),
                '%vSub' => rand(1,9),
                '%status' => rand(200, 599),
            ];
            $str = strtr($template, $generated);
            file_put_contents($address, $str, FILE_APPEND);
            $this->info($str);
        }

    }
}
