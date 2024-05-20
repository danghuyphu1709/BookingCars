<?php

namespace App\Console\Commands;
use App\Repositories\Interface\TicketInterface;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;


class DeparturateDayComand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:departurate-day-comand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description run now status';

    protected $ticketRepo;

    public function __construct( TicketInterface $TicketInterface)
    {
        parent::__construct();
        $this->ticketRepo = $TicketInterface;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $current_time = Carbon::now()->format('H:i');
        $runDeparture = $this->ticketRepo->getTimeRun();
        foreach ($runDeparture as $item){
            $formatted_preparation_time = Carbon::parse($item->preparation_time)->format('H:i');
            if ($formatted_preparation_time == $current_time) {
               $this->ticketRepo->statusChange($item->id);
            }else{
                Log::info('Thời gian chuẩn bị khác nhau với thời gian hiện tại: id'.$item->id . $formatted_preparation_time .$current_time
                );
            }
        }

    }
}
