<?php

namespace App\Console\Commands;

use App\Mail\DailyReportingEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;
use App\Models\CRM\LeadStatus;
use App\Models\CRM\LeadSubStatus;
use App\Models\CRM\ProjectNewStatus;
use App\Models\CRM\Regie;
use App\Models\CRM\StatusChangeLog;
use App\Models\User;
use Illuminate\Support\Facades\File;

class DailyReporting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:daily-reporting';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $telecommercial_users = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
        $regies = Regie::all();
        $ko_status = LeadStatus::find(5);
        $chantier_ko_status = ProjectNewStatus::find(7);
        $chart = [];
        
        $path = public_path('uploads/chart-image');
        if(!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
       
        //########## section converti chart start ##########// 
            $section_converti_datay = [];
            $section_converti_datax = [];

            foreach($telecommercial_users as $telecommercial_user){
                $section_converti_datay[] = StatusChangeLog::whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-d'))->where('type', 'lead')->where('status_type', 'main')->where('to_id', 7)->where('telecommercial_id', $telecommercial_user->id)->count();
                $section_converti_datax[] = $telecommercial_user->name;
            }
            // Setup the graph. 
            $section_converti = new Graph\Graph(900, 500);
            $section_converti->img->SetMargin(60, 20, 35, 75);
            $section_converti->SetScale('textlin');
            $section_converti->SetMarginColor('lightblue:1.1');
            $section_converti->SetShadow();

            // Setup font for axis
            $section_converti->xaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);
            $section_converti->yaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);

            // Show 0 label on Y-axis (default is not to show)
            $section_converti->yscale->ticks->SupressZeroLabel(false);

            // Setup X-axis labels
            $section_converti->xaxis->SetTickLabels($section_converti_datax);
            $section_converti->xaxis->SetLabelAngle(75);

            // Create the bar pot
            $section_converti_bplot = new Plot\BarPlot($section_converti_datay);
            $section_converti_bplot->SetWidth(0.6);

            // Setup color for gradient fill style
            $section_converti_bplot->SetFillGradient('navy:0.9', 'navy:1.85', GRAD_LEFT_REFLECTION);

            // Set color for the frame of each bar
            $section_converti_bplot->SetColor('white');
            $section_converti->Add($section_converti_bplot);

            // Finally generate the image

            $gdImgHandler = $section_converti->Stroke(_IMG_HANDLER);
            $section_converti_file = time()."converti.png";
            
            $fileName = $path.'/'.$section_converti_file;
            $section_converti->img->Stream($fileName);

        //########## section converti chart end ##########// 
        
        //########## section ko chart start ##########// 
            //########## section ko Regie chart start ##########//
                 
                $section_ko_regie_data = [];
                $section_ko_regie_legends = [];

                foreach($regies as $regie){
                    $count = StatusChangeLog::whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-d'))->where('type', 'lead')->where('status_type', 'main')->where('to_id', 5)->where('regie_id', $regie->id)->count();
                    if($count > 0){
                        $section_ko_regie_data[] = $count;
                        $section_ko_regie_legends[] = $regie->name;
                    }
                }
 
                if(count($section_ko_regie_data) > 0){
                    $section_ko_regie = new Graph\PieGraph(900,600);
                    $section_ko_regie->SetShadow();
                    
                    $section_ko_regie_p1 = new Plot\PiePlot($section_ko_regie_data);
                    $section_ko_regie_p1->SetLegends($section_ko_regie_legends);
                    $section_ko_regie_p1->SetSize(0.25);
                    $section_ko_regie_p1->SetCenter(0.5);
                    
                    $section_ko_regie->Add($section_ko_regie_p1); 
    
                    $gdImgHandler = $section_ko_regie->Stroke(_IMG_HANDLER);
                    $section_ko_regie_file = time()."ko-regie.png";
                    
                    $fileName = $path.'/'.$section_ko_regie_file;
                    $section_ko_regie->img->Stream($fileName); 
                }else{
                    $section_ko_regie_file = null;
                }


            //########## section ko Regie chart End ##########//
            //########## section ko telecommercial chart start ##########// 

                $section_ko_telecommercial_datay = [];
                $section_ko_telecommercial_datax = [];

                foreach($telecommercial_users as $telecommercial_user){
                    $section_ko_telecommercial_datay[] = StatusChangeLog::whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-d'))->where('type', 'lead')->where('status_type', 'main')->where('to_id', 5)->where('telecommercial_id', $telecommercial_user->id)->count();
                    $section_ko_telecommercial_datax[] = $telecommercial_user->name;
                }
                // Setup the graph. 
                $section_ko_telecommercial = new Graph\Graph(900, 500);
                $section_ko_telecommercial->img->SetMargin(60, 20, 35, 75);
                $section_ko_telecommercial->SetScale('textlin');
                $section_ko_telecommercial->SetMarginColor('lightblue:1.1');
                $section_ko_telecommercial->SetShadow();
        
                // Setup font for axis
                $section_ko_telecommercial->xaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);
                $section_ko_telecommercial->yaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);

                // Show 0 label on Y-axis (default is not to show)
                $section_ko_telecommercial->yscale->ticks->SupressZeroLabel(false);

                // Setup X-axis labels
                $section_ko_telecommercial->xaxis->SetTickLabels($section_ko_telecommercial_datax);
                $section_ko_telecommercial->xaxis->SetLabelAngle(75);

                // Create the bar pot
                $section_ko_telecommercial_bplot = new Plot\BarPlot($section_ko_telecommercial_datay);
                $section_ko_telecommercial_bplot->SetWidth(0.6);

                // Setup color for gradient fill style
                $section_ko_telecommercial_bplot->SetFillGradient('navy:0.9', 'navy:1.85', GRAD_LEFT_REFLECTION);

                // Set color for the frame of each bar
                $section_ko_telecommercial_bplot->SetColor('white');
                $section_ko_telecommercial->Add($section_ko_telecommercial_bplot);

                // Finally generate the image

                $gdImgHandler = $section_ko_telecommercial->Stroke(_IMG_HANDLER);
                $section_ko_telecommercial_file = time()."ko-telecomerical.png";
                
                $fileName = $path.'/'.$section_ko_telecommercial_file;
                $section_ko_telecommercial->img->Stream($fileName); 

            //########## section ko telecommercial chart end ##########//

            //########## section ko statut chart start ##########// 

                $section_ko_statut_datay = [];
                $section_ko_statut_datax = [];

                foreach($ko_status->getSubStatus as $ko_statut){
                    $section_ko_statut_datay[] = StatusChangeLog::whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-d'))->where('type', 'lead')->where('status_type', 'main')->where('to_id', 5)->where('statut_id', $ko_statut->id)->count();
                    $section_ko_statut_datax[] = $ko_statut->name;
                }
                // Setup the graph. 
                $section_ko_statut = new Graph\Graph(900, 500);
                $section_ko_statut->img->SetMargin(60, 20, 35, 75);
                $section_ko_statut->SetScale('textlin');
                $section_ko_statut->SetMarginColor('lightblue:1.1');
                $section_ko_statut->SetShadow();
        
                // Setup font for axis
                $section_ko_statut->xaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);
                $section_ko_statut->yaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);

                // Show 0 label on Y-axis (default is not to show)
                $section_ko_statut->yscale->ticks->SupressZeroLabel(false);

                // Setup X-axis labels
                $section_ko_statut->xaxis->SetTickLabels($section_ko_statut_datax);
                $section_ko_statut->xaxis->SetLabelAngle(75);

                // Create the bar pot
                $section_ko_statut_bplot = new Plot\BarPlot($section_ko_statut_datay);
                $section_ko_statut_bplot->SetWidth(0.6);

                // Setup color for gradient fill style
                $section_ko_statut_bplot->SetFillGradient('navy:0.9', 'navy:1.85', GRAD_LEFT_REFLECTION);

                // Set color for the frame of each bar
                $section_ko_statut_bplot->SetColor('white');
                $section_ko_statut->Add($section_ko_statut_bplot);

                // Finally generate the image

                $gdImgHandler = $section_ko_statut->Stroke(_IMG_HANDLER);
                $section_ko_statut_file = time()."ko-statut.png";
                
                $fileName = $path.'/'.$section_ko_statut_file;
                $section_ko_statut->img->Stream($fileName); 

            //########## section ko statut chart end ##########// 
        //########## section ko chart end ##########// 
        //########## chantier section ko chart start ##########// 
            //########## chantier section ko Regie chart start ##########//
                 
                $chantier_section_ko_regie_data = [];
                $chantier_section_ko_regie_legends = [];

                foreach($regies as $regie){
                    $count = StatusChangeLog::whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-d'))->where('type', 'project')->where('status_type', 'main')->where('to_id', 7)->where('regie_id', $regie->id)->count();
                    if($count > 0){
                        $chantier_section_ko_regie_data[] = $count;
                        $chantier_section_ko_regie_legends[] = $regie->name;
                    }
                }
 
                if(count($chantier_section_ko_regie_data) > 0){
                    $chantier_section_ko_regie = new Graph\PieGraph(900,600);
                    $chantier_section_ko_regie->SetShadow();
                    
                    $chantier_section_ko_regie_p1 = new Plot\PiePlot($chantier_section_ko_regie_data);
                    $chantier_section_ko_regie_p1->SetLegends($chantier_section_ko_regie_legends);
                    $chantier_section_ko_regie_p1->SetSize(0.25);
                    $chantier_section_ko_regie_p1->SetCenter(0.5);
                    
                    $chantier_section_ko_regie->Add($chantier_section_ko_regie_p1); 
    
                    $gdImgHandler = $chantier_section_ko_regie->Stroke(_IMG_HANDLER);
                    $chantier_section_ko_regie_file = time()."chantier-ko-regie.png";
                    
                    $fileName = $path.'/'.$chantier_section_ko_regie_file;
                    $chantier_section_ko_regie->img->Stream($fileName); 
                }else{
                    $chantier_section_ko_regie_file = null;
                }


            //########## chantier section ko Regie chart End ##########//
            //########## chantier section ko telecommercial chart start ##########// 

                $chantier_section_ko_telecommercial_datay = [];
                $chantier_section_ko_telecommercial_datax = [];

                foreach($telecommercial_users as $telecommercial_user){
                    $chantier_section_ko_telecommercial_datay[] = StatusChangeLog::whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-d'))->where('type', 'project')->where('status_type', 'main')->where('to_id', 7)->where('telecommercial_id', $telecommercial_user->id)->count();
                    $chantier_section_ko_telecommercial_datax[] = $telecommercial_user->name;
                }
                // Setup the graph. 
                $chantier_section_ko_telecommercial = new Graph\Graph(900, 500);
                $chantier_section_ko_telecommercial->img->SetMargin(60, 20, 35, 75);
                $chantier_section_ko_telecommercial->SetScale('textlin');
                $chantier_section_ko_telecommercial->SetMarginColor('lightblue:1.1');
                $chantier_section_ko_telecommercial->SetShadow();
        
                // Setup font for axis
                $chantier_section_ko_telecommercial->xaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);
                $chantier_section_ko_telecommercial->yaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);

                // Show 0 label on Y-axis (default is not to show)
                $chantier_section_ko_telecommercial->yscale->ticks->SupressZeroLabel(false);

                // Setup X-axis labels
                $chantier_section_ko_telecommercial->xaxis->SetTickLabels($chantier_section_ko_telecommercial_datax);
                $chantier_section_ko_telecommercial->xaxis->SetLabelAngle(75);

                // Create the bar pot
                $chantier_section_ko_telecommercial_bplot = new Plot\BarPlot($chantier_section_ko_telecommercial_datay);
                $chantier_section_ko_telecommercial_bplot->SetWidth(0.6);

                // Setup color for gradient fill style
                $chantier_section_ko_telecommercial_bplot->SetFillGradient('navy:0.9', 'navy:1.85', GRAD_LEFT_REFLECTION);

                // Set color for the frame of each bar
                $chantier_section_ko_telecommercial_bplot->SetColor('white');
                $chantier_section_ko_telecommercial->Add($chantier_section_ko_telecommercial_bplot);

                // Finally generate the image

                $gdImgHandler = $chantier_section_ko_telecommercial->Stroke(_IMG_HANDLER);
                $chantier_section_ko_telecommercial_file = time()."chantier-ko-telecomerical.png";
                
                $fileName = $path.'/'.$chantier_section_ko_telecommercial_file;
                $chantier_section_ko_telecommercial->img->Stream($fileName); 

            //########## chantier section ko telecommercial chart end ##########//

            //########## chantier section ko statut chart start ##########// 

                $chantier_section_ko_statut_datay = [];
                $chantier_section_ko_statut_datax = [];

                foreach($chantier_ko_status->getSubStatus as $ko_statut){
                    $chantier_section_ko_statut_datay[] = StatusChangeLog::whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-d'))->where('type', 'project')->where('status_type', 'main')->where('to_id', 7)->where('statut_id', $ko_statut->id)->count();
                    $chantier_section_ko_statut_datax[] = $ko_statut->name;
                }
                // Setup the graph. 
                $chantier_section_ko_statut = new Graph\Graph(900, 500);
                $chantier_section_ko_statut->img->SetMargin(60, 20, 35, 75);
                $chantier_section_ko_statut->SetScale('textlin');
                $chantier_section_ko_statut->SetMarginColor('lightblue:1.1');
                $chantier_section_ko_statut->SetShadow();
        
                // Setup font for axis
                $chantier_section_ko_statut->xaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);
                $chantier_section_ko_statut->yaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);

                // Show 0 label on Y-axis (default is not to show)
                $chantier_section_ko_statut->yscale->ticks->SupressZeroLabel(false);

                // Setup X-axis labels
                $chantier_section_ko_statut->xaxis->SetTickLabels($chantier_section_ko_statut_datax);
                $chantier_section_ko_statut->xaxis->SetLabelAngle(75);

                // Create the bar pot
                $chantier_section_ko_statut_bplot = new Plot\BarPlot($chantier_section_ko_statut_datay);
                $chantier_section_ko_statut_bplot->SetWidth(0.6);

                // Setup color for gradient fill style
                $chantier_section_ko_statut_bplot->SetFillGradient('navy:0.9', 'navy:1.85', GRAD_LEFT_REFLECTION);

                // Set color for the frame of each bar
                $chantier_section_ko_statut_bplot->SetColor('white');
                $chantier_section_ko_statut->Add($chantier_section_ko_statut_bplot);

                // Finally generate the image

                $gdImgHandler = $chantier_section_ko_statut->Stroke(_IMG_HANDLER);
                $chantier_section_ko_statut_file = time()."chantier-ko-statut.png";
                
                $fileName = $path.'/'.$chantier_section_ko_statut_file;
                $chantier_section_ko_statut->img->Stream($fileName); 

            //########## chantier section ko statut chart end ##########// 
        //########## chantier section ko chart end ##########// 


        // Chart Code end  


        $chart['section_converti_chart'] = $section_converti_file;
        $chart['section_ko_telecommercial_chart'] = $section_ko_telecommercial_file;
        $chart['section_ko_regie_chart'] = $section_ko_regie_file;
        $chart['section_ko_statut_chart'] = $section_ko_statut_file;
        $chart['chantier_section_ko_telecommercial_chart'] = $chantier_section_ko_telecommercial_file;
        $chart['chantier_section_ko_regie_chart'] = $chantier_section_ko_regie_file;
        $chart['chantier_section_ko_statut_chart'] = $chantier_section_ko_statut_file;

        Mail::to('nicolas@novecology.fr')->send(new DailyReportingEmail($chart));
        Mail::to('dgtaltech.shimul@gmail.com')->send(new DailyReportingEmail($chart));

        return 0;
    }
}
