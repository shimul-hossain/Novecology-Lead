<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\CRM\Account;
use App\Models\CRM\Information;
use App\Models\CRM\NewClient;
use App\Models\CRM\NewProject;
use Carbon\Carbon;
use DOMDocument;
use DOMXPath;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
// use Goutte\Client;
// use Symfony\Component\HttpClient\HttpClient;

class ScraperController extends Controller
{
    
    public function index(){

        $client = new Client(); 


        // $data = $client->request('POST', 'https://cfsmsp.impots.gouv.fr//secavis/faces/commun/index.jsf;jsessionid=72F0E77DE80EF252B641E80C6E787EE5.secavis-02-01');
        
        //  $data->filter('.titre_affiche_avis span')->each(function($node){
        //            echo $node->text() .'<br/>'; 
            
        //      });
        $response = $client->request('POST', 'https://cfsmsp.impots.gouv.fr//secavis/faces/commun/index.jsf;jsessionid=72F0E77DE80EF252B641E80C6E787EE5.secavis-02-01', [
            'form_params' => [
                'j_id_7:spi' => '1784204702168',
                'j_id_7:num_facture' => '2048a02287626',
                'javax.faces.ViewState' => 'RxJe/1JKTJSr3aiM3H9DqZq0DrwqEXsY7Rw4eLRgEBsCF1IALJGqVgWTaQkiKbbdcGDWW774BWUCa/+j2CDznhw1/3bxJteY6ZCui66yNevhkej4xuyrFMte5KQnKORt9JZrOQ==',
               
            ]
        ]);

        return $response->getBody();

        // $data = $client->request('GET', 'https://www.dgtaltech.com/');
        //  $data->filter('.col-12.wow.fadeIn h2')->each(function($node){
        //        echo $node->text() .'<br/>'; 

        //  });

    }

    public function mpr(Request $request)
    {
        $project = NewProject::find($request->project_id); 
        if($project && $project->Compte_MaPrimeRenov_email && $project->Compte_MaPrimeRenov_Mots_de_passe){
            $username = $project->Compte_MaPrimeRenov_email;
            $password = $project->Compte_MaPrimeRenov_Mots_de_passe;
        }else{
            return response()->json(['error' => 'Aucun compte MyPrimeRenov trouvé']);
        }

        


        function getDetails($username, $password)
        {

            $useragents = [
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.4 Safari/605.1.15',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.88 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.0.0 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.61 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.2 Safari/605.1.15',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.1 Safari/605.1.15',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.2 Safari/605.1.15',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.3 Safari/605.1.15',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.4 Safari/605.1.15',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.5 Safari/605.1.15',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:100.0) Gecko/20100101 Firefox/100.0',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:101.0) Gecko/20100101 Firefox/101.0',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:99.0) Gecko/20100101 Firefox/99.0',
                'Mozilla/5.0 (Windows NT 10.0; rv:91.0) Gecko/20100101 Firefox/91.0',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36 OPR/86.0.4363.59',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36 OPR/86.0.4363.64',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.143 YaBrowser/22.5.0.1814 Yowser/2.5 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.75 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.88 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.0.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36 Edg/101.0.1210.32',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36 Edg/101.0.1210.39',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.47',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.53',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.61 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.62 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.63 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.63 Safari/537.36 Edg/102.0.1245.30',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.141 YaBrowser/22.3.3.852 Yowser/2.5 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36 OPR/85.0.4341.71',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36 OPR/85.0.4341.75',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:100.0) Gecko/20100101 Firefox/100.0',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:101.0) Gecko/20100101 Firefox/101.0',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:102.0) Gecko/20100101 Firefox/102.0',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:91.0) Gecko/20100101 Firefox/91.0',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:99.0) Gecko/20100101 Firefox/99.0',
                'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:100.0) Gecko/20100101 Firefox/100.0',
                'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36',
                'Mozilla/5.0 (X11; Fedora; Linux x86_64; rv:100.0) Gecko/20100101 Firefox/100.0',
                'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36',
                'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36',
                'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36',
                'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36',
                'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36',
                'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36',
                'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.61 Safari/537.36',
                'Mozilla/5.0 (X11; Linux x86_64; rv:100.0) Gecko/20100101 Firefox/100.0',
                'Mozilla/5.0 (X11; Linux x86_64; rv:101.0) Gecko/20100101 Firefox/101.0',
                'Mozilla/5.0 (X11; Linux x86_64; rv:78.0) Gecko/20100101 Firefox/78.0',
                'Mozilla/5.0 (X11; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0',
                'Mozilla/5.0 (X11; Linux x86_64; rv:95.0) Gecko/20100101 Firefox/95.0',
                'Mozilla/5.0 (X11; Linux x86_64; rv:99.0) Gecko/20100101 Firefox/99.0',
                'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:100.0) Gecko/20100101 Firefox/100.0',
                'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:99.0) Gecko/20100101 Firefox/99.0',
            ];
            shuffle($useragents);

            $config = ['timeout' => 120, 'decode_content' => true, 'cookies' => true, 'verify' => false, 'version' => 1.1, 'debug' => false,

                /*'proxy'=>'http://username:password@ip:port',*/
                //'proxy'=>'http://127.0.0.1:8080',
                'headers' => [
                    'User-Agent' => $useragents[0],
                    'Accept-Encoding' => 'gzip, deflate',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                    'Accept-Language' => 'en-US,en;q=0.5',
                ]];

            $guzzle = new Client(
                $config
            );

            $guzzle->get('https://www.maprimerenov.gouv.fr/prweb/PRAuth/app/default/H9DF1ufnPCNDOGG8PFgaaW3tLvvaZHE9*/!STANDARD?pyActivity=Code-Security.EndSession&pzAuth=guest&ShowLogoffScreen')->getBody()->getContents();
            $html = $guzzle->get('https://auth.anah.fr/saml/singleSignOn')->getBody()->getContents();

            $url = 'https://auth.anah.fr/saml/singleSignOn';

            $params = getFormParams($html, '//*[@id="lformLDAP"]');


            $values = $params[1];
            $values['user'] = $username;
            $values['password'] = $password;
            $values['timezone'] = '2';  //2 for GMT+2

            $html = $guzzle->post($url, ['form_params' => $values])->getBody()->getContents();
            // if (stripos($html, 'trspan="connectedAs">Connected as') === false) {
            //     echo 'login failed' . PHP_EOL;
            // }

            $html = $guzzle->get('https://maprimerenov.gouv.fr/prweb/PRAuth/DemandeursSSO')->getBody()->getContents();
            $params = getFormParams($html, '//form');
            $html = $guzzle->post($params[0], ['form_params' => $params[1]])->getBody()->getContents();
            $params = getFormParams($html, '//*[@id="form"]');
            $html = $guzzle->post($params[0], ['form_params' => $params[1]])->getBody()->getContents();
            $params = getFormParams($html, '//form');
            $html = $guzzle->post($params[0], ['form_params' => $params[1]])->getBody()->getContents();


            return parseDetails($html);
        }


        function getFormParams($html, $xPathForForm = '//*[@id="lformLDAP"]')
        {
            $html_dom = new DOMDocument();
            @$html_dom->loadHTML($html);
            $xpath = new DOMXPath($html_dom);
            $links = $xpath->query($xPathForForm);
            $formUrl = $links[0]->getAttribute('action');

            $_nodes = $links[0]->getElementsByTagName('input');
            $params = [];
            foreach ($_nodes as $node) {
                $params[$node->getAttribute('name')] = $node->getAttribute('value');
            }

            return [$formUrl, $params];

        }

        function parseDetails($html)
        {
            $html_dom = new DOMDocument();
            @$html_dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
            $xpath = new DOMXPath($html_dom);

            $all_details = [];
            $details = [];

            // $links = $xpath->query('//*[contains(@class,"standard_bold_dataLabelRead")]');
            // $details['number'] = $links[1]->nodeValue;
            // $details['works'] = $links[3]->nodeValue;


            // $links = $xpath->query('//*[contains(@string_type,"field")]');
            // $details['date'] = $links[3]->nodeValue;
            // $details['address'] = $links[5]->nodeValue;

            // $links = $xpath->query('//*[contains(@class,"rightJustifyStyle")]');
            // $details['amount'] = $links[0]->nodeValue;
            // $details['amount'] = preg_replace('/[^0-9]/', '', $details['amount'] );

            // $links = $xpath->query('//*[contains(@class,"Standard_rectangular")]');
            // $details['status1'] = $links[0]->nodeValue;
            // $details['status2'] = $links[1]->nodeValue;


            $arr_mpr_file = $xpath->query('//*[contains(@class,"content-item content-label item-2 remove-bottom-spacing remove-right-spacing    standard_bold_dataLabelRead dataLabelRead standard_bold_dataLabelRead flex flex-row")]');

            $arr_deposited_work =  $xpath->query('//*[contains(@class,"content-item content-label item-2 remove-bottom-spacing remove-right-spacing    standard_bold_dataLabelRead dataLabelRead standard_medium_dataLabelRead flex flex-row")]');

            $arr_address = $xpath->query('//*[contains(@class,"content-item content-field item-2 remove-top-spacing remove-bottom-spacing remove-left-spacing   standard_small_dataLabelRead dataValueRead flex flex-row")]');

            $arr_status_1 = $xpath->query('//*[contains(@class,"content-item content-field item-1 remove-top-spacing remove-bottom-spacing remove-left-spacing    right-aligned dataValueRead flex flex-row ")]');

            $arr_status_2 = $xpath->query('//*[contains(@class,"content-item content-field item-2 remove-top-spacing remove-bottom-spacing remove-left-spacing") and (contains(@class,"remove-right-spacing") or not(contains(@class,"remove-right-spacing"))) and contains(@class,"right-aligned dataValueRead flex flex-row")]');

            $arr_deposit_date = $xpath->query('//*[contains(@class,"content-item content-field item-2 remove-bottom-spacing remove-right-spacing   right-aligned dataValueRead flex flex-row ")]');

            $arr_estimated_amount = $xpath->query('//*[contains(@class,"content-item content-field item-1 remove-top-spacing remove-bottom-spacing remove-left-spacing remove-right-spacing   right-aligned dataValueRead flex flex-row")]');

        
            for ($x = 0; $x<count($arr_mpr_file); $x++) {

                $details['number'] =  $arr_mpr_file[$x]->nodeValue ?? 'No data available';
                $details['works'] =   $arr_deposited_work[$x]->nodeValue ?? 'No data available';
                $details['address'] = $arr_address[$x]->nodeValue ?? 'No data available';
                $details['status1'] = $arr_status_1[$x]->nodeValue ?? 'No data available';
                $details['status2'] = $arr_status_2[$x]->nodeValue ?? 'No data available';
                $details['deposit_date'] = $arr_deposit_date[$x]->nodeValue ?? 'No data available';
                $details['estimated_amount'] = $arr_estimated_amount[$x]->nodeValue ?? 0;
                $details['estimated_amount'] = preg_replace('/[^0-9]/', '', $details['estimated_amount']) ?? 0;


                array_push($all_details, $details);
                //dd($targeted_li[$x]);
               
            }



            
          

            return $all_details;
        }  

            $data =  json_encode(getDetails($username,$password), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
            $mydata = json_decode($data, true); 

            $main_data_json = [];

            if(count($mydata) == 1){
                $project->Date_de_dépôt_MyMPR                           = $mydata[0]['deposit_date'];
                $project->N_Dossier_MPR_hyphen_MyMPR                    = $mydata[0]['number'];
                $project->Montant_subvention_prévisionnel_hyphen_MyMPR  = $mydata[0]['estimated_amount'];
                $project->Travaux_deposés_hyphen_MyMPR                  = $mydata[0]['works'];
                $project->Statut_1_hyphen_MyMPR                         = $mydata[0]['status1'];
                $project->Statut_2_hyphen_MyMPR                         = $mydata[0]['status2'];
                $project->Adresse_hyphen_MyMPR                          = $mydata[0]['address'];
                $project->save(); 
            }

             for ($x = 0; $x<count($mydata); $x++) {
                array_push(
                    $main_data_json, 
                [
                    'mpr_file' =>$mydata[$x]['number'], 
                    'deposited_work' => $mydata[$x]['works'], 
                    'address' => $mydata[$x]['address'], 
                    'status_1'=> $mydata[$x]['status1'], 
                    'status_2' => $mydata[$x]['status2'], 
                    'deposit_date' => $mydata[$x]['deposit_date'], 
                    'estimated_amount' =>  $mydata[$x]['estimated_amount']
                ]
            );
                //dd($targeted_li[$x]);
               
            }          

            $view = view('admin.mpr_info', compact('main_data_json', 'project'))->render();


            return response()->json(['data' => $main_data_json, 'body' => $view]);
    }
    public function mprInfoUpdate(Request $request)
    {
        $project = NewProject::find($request->project_id); 
        if($project && $project->Compte_MaPrimeRenov_email && $project->Compte_MaPrimeRenov_Mots_de_passe){
            $username = $project->Compte_MaPrimeRenov_email;
            $password = $project->Compte_MaPrimeRenov_Mots_de_passe;
        }else{
            return response()->json(['error' => 'Aucun compte MyPrimeRenov trouvé']);
        }

        


        function getDetails($username, $password)
        {

            $useragents = [
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.4 Safari/605.1.15',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.88 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.0.0 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.61 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.2 Safari/605.1.15',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.1 Safari/605.1.15',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.2 Safari/605.1.15',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.3 Safari/605.1.15',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.4 Safari/605.1.15',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.5 Safari/605.1.15',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:100.0) Gecko/20100101 Firefox/100.0',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:101.0) Gecko/20100101 Firefox/101.0',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:99.0) Gecko/20100101 Firefox/99.0',
                'Mozilla/5.0 (Windows NT 10.0; rv:91.0) Gecko/20100101 Firefox/91.0',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36 OPR/86.0.4363.59',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36 OPR/86.0.4363.64',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.143 YaBrowser/22.5.0.1814 Yowser/2.5 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.75 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.88 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.0.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36 Edg/101.0.1210.32',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36 Edg/101.0.1210.39',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.47',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36 Edg/101.0.1210.53',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.61 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.62 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.63 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.63 Safari/537.36 Edg/102.0.1245.30',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.141 YaBrowser/22.3.3.852 Yowser/2.5 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36 OPR/85.0.4341.71',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36 OPR/85.0.4341.75',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:100.0) Gecko/20100101 Firefox/100.0',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:101.0) Gecko/20100101 Firefox/101.0',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:102.0) Gecko/20100101 Firefox/102.0',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:91.0) Gecko/20100101 Firefox/91.0',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:99.0) Gecko/20100101 Firefox/99.0',
                'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:100.0) Gecko/20100101 Firefox/100.0',
                'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36',
                'Mozilla/5.0 (X11; Fedora; Linux x86_64; rv:100.0) Gecko/20100101 Firefox/100.0',
                'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36',
                'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36',
                'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36',
                'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36',
                'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36',
                'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36',
                'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.61 Safari/537.36',
                'Mozilla/5.0 (X11; Linux x86_64; rv:100.0) Gecko/20100101 Firefox/100.0',
                'Mozilla/5.0 (X11; Linux x86_64; rv:101.0) Gecko/20100101 Firefox/101.0',
                'Mozilla/5.0 (X11; Linux x86_64; rv:78.0) Gecko/20100101 Firefox/78.0',
                'Mozilla/5.0 (X11; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0',
                'Mozilla/5.0 (X11; Linux x86_64; rv:95.0) Gecko/20100101 Firefox/95.0',
                'Mozilla/5.0 (X11; Linux x86_64; rv:99.0) Gecko/20100101 Firefox/99.0',
                'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:100.0) Gecko/20100101 Firefox/100.0',
                'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:99.0) Gecko/20100101 Firefox/99.0',
            ];
            shuffle($useragents);

            $config = ['timeout' => 120, 'decode_content' => true, 'cookies' => true, 'verify' => false, 'version' => 1.1, 'debug' => false,

                /*'proxy'=>'http://username:password@ip:port',*/
                //'proxy'=>'http://127.0.0.1:8080',
                'headers' => [
                    'User-Agent' => $useragents[0],
                    'Accept-Encoding' => 'gzip, deflate',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                    'Accept-Language' => 'en-US,en;q=0.5',
                ]];

            $guzzle = new Client(
                $config
            );

            $guzzle->get('https://www.maprimerenov.gouv.fr/prweb/PRAuth/app/default/H9DF1ufnPCNDOGG8PFgaaW3tLvvaZHE9*/!STANDARD?pyActivity=Code-Security.EndSession&pzAuth=guest&ShowLogoffScreen')->getBody()->getContents();
            $html = $guzzle->get('https://auth.anah.fr/saml/singleSignOn')->getBody()->getContents();

            $url = 'https://auth.anah.fr/saml/singleSignOn';

            $params = getFormParams($html, '//*[@id="lformLDAP"]');


            $values = $params[1];
            $values['user'] = $username;
            $values['password'] = $password;
            $values['timezone'] = '2';  //2 for GMT+2

            $html = $guzzle->post($url, ['form_params' => $values])->getBody()->getContents();
            // if (stripos($html, 'trspan="connectedAs">Connected as') === false) {
            //     echo 'login failed' . PHP_EOL;
            // }

            $html = $guzzle->get('https://maprimerenov.gouv.fr/prweb/PRAuth/DemandeursSSO')->getBody()->getContents();
            $params = getFormParams($html, '//form');
            $html = $guzzle->post($params[0], ['form_params' => $params[1]])->getBody()->getContents();
            $params = getFormParams($html, '//*[@id="form"]');
            $html = $guzzle->post($params[0], ['form_params' => $params[1]])->getBody()->getContents();
            $params = getFormParams($html, '//form');
            $html = $guzzle->post($params[0], ['form_params' => $params[1]])->getBody()->getContents();


            return parseDetails($html);
        }


        function getFormParams($html, $xPathForForm = '//*[@id="lformLDAP"]')
        {
            $html_dom = new DOMDocument();
            @$html_dom->loadHTML($html);
            $xpath = new DOMXPath($html_dom);
            $links = $xpath->query($xPathForForm);
            $formUrl = $links[0]->getAttribute('action');

            $_nodes = $links[0]->getElementsByTagName('input');
            $params = [];
            foreach ($_nodes as $node) {
                $params[$node->getAttribute('name')] = $node->getAttribute('value');
            }

            return [$formUrl, $params];

        }

        function parseDetails($html)
        {
            $html_dom = new DOMDocument();
            @$html_dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
            $xpath = new DOMXPath($html_dom);

            $all_details = [];
            $details = [];

            // $links = $xpath->query('//*[contains(@class,"standard_bold_dataLabelRead")]');
            // $details['number'] = $links[1]->nodeValue;
            // $details['works'] = $links[3]->nodeValue;


            // $links = $xpath->query('//*[contains(@string_type,"field")]');
            // $details['date'] = $links[3]->nodeValue;
            // $details['address'] = $links[5]->nodeValue;

            // $links = $xpath->query('//*[contains(@class,"rightJustifyStyle")]');
            // $details['amount'] = $links[0]->nodeValue;
            // $details['amount'] = preg_replace('/[^0-9]/', '', $details['amount'] );

            // $links = $xpath->query('//*[contains(@class,"Standard_rectangular")]');
            // $details['status1'] = $links[0]->nodeValue;
            // $details['status2'] = $links[1]->nodeValue;


            $arr_mpr_file = $xpath->query('//*[contains(@class,"content-item content-label item-2 remove-bottom-spacing remove-right-spacing    standard_bold_dataLabelRead dataLabelRead standard_bold_dataLabelRead flex flex-row")]');

            $arr_deposited_work =  $xpath->query('//*[contains(@class,"content-item content-label item-2 remove-bottom-spacing remove-right-spacing    standard_bold_dataLabelRead dataLabelRead standard_medium_dataLabelRead flex flex-row")]');

            $arr_address = $xpath->query('//*[contains(@class,"content-item content-field item-2 remove-top-spacing remove-bottom-spacing remove-left-spacing   standard_small_dataLabelRead dataValueRead flex flex-row")]');

            $arr_status_1 = $xpath->query('//*[contains(@class,"content-item content-field item-1 remove-top-spacing remove-bottom-spacing remove-left-spacing    right-aligned dataValueRead flex flex-row ")]');

            $arr_status_2 = $xpath->query('//*[contains(@class,"content-item content-field item-2 remove-top-spacing remove-bottom-spacing remove-left-spacing    right-aligned dataValueRead flex flex-row ")]');

            $arr_deposit_date = $xpath->query('//*[contains(@class,"content-item content-field item-2 remove-bottom-spacing remove-right-spacing   right-aligned dataValueRead flex flex-row ")]');

            $arr_estimated_amount = $xpath->query('//*[contains(@class,"content-item content-field item-1 remove-top-spacing remove-bottom-spacing remove-left-spacing remove-right-spacing   right-aligned dataValueRead flex flex-row")]');


            for ($x = 0; $x<count($arr_mpr_file); $x++) {

                $details['number'] =  $arr_mpr_file[$x]->nodeValue ?? "No data available";
                $details['works'] =   $arr_deposited_work[$x]->nodeValue ?? "No data available";
                $details['address'] = $arr_address[$x]->nodeValue ?? "No data available";
                $details['status1'] = $arr_status_1[$x]->nodeValue ?? "No data available";
                $details['status2'] = $arr_status_2[$x]->nodeValue ?? "No data available";
                $details['deposit_date'] = $arr_deposit_date[$x]->nodeValue ?? "No data available";
                $details['estimated_amount'] = $arr_estimated_amount[$x]->nodeValue ?? 0;
                $details['estimated_amount'] = preg_replace('/[^0-9]/', '', $details['estimated_amount']) ?? 0;


                array_push($all_details, $details);
                //dd($targeted_li[$x]);
               
            }



            
          

            return $all_details;
            }

            $data =  json_encode(getDetails($username,$password), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
            $mydata = json_decode($data, true); 

            $main_data_json = [];

            $project = NewProject::find($request->project_id);
            if(count($mydata) == 1){
                $project->update([
                    'N_Dossier_MPR_hyphen_MyMPR' =>$mydata[0]['number'],   
                    'Adresse_hyphen_MyMPR' => $mydata[0]['address'], 
                    'Statut_1_hyphen_MyMPR'=> $mydata[0]['status1'], 
                    'Statut_2_hyphen_MyMPR' => $mydata[0]['status2'], 
                    'Date_de_dépôt_MyMPR' => $mydata[0]['deposit_date'], 
                    'Montant_subvention_prévisionnel_hyphen_MyMPR' =>  $mydata[0]['estimated_amount'],
                ]);
            }else{
                for ($x = 0; $x<count($mydata); $x++) {
                    
                    if($project->N_Dossier_MPR_hyphen_MyMPR == $mydata[$x]['number']){
                        $project->update([
                            'N_Dossier_MPR_hyphen_MyMPR' =>$mydata[$x]['number'],   
                            'Adresse_hyphen_MyMPR' => $mydata[$x]['address'], 
                            'Statut_1_hyphen_MyMPR'=> $mydata[$x]['status1'], 
                            'Statut_2_hyphen_MyMPR' => $mydata[$x]['status2'], 
                            'Date_de_dépôt_MyMPR' => $mydata[$x]['deposit_date'], 
                            'Montant_subvention_prévisionnel_hyphen_MyMPR' =>  $mydata[$x]['estimated_amount'],
                        ]);
                    } 
                }        
            }

            $project->mpr_updated_at = Carbon::now();
            $project->save();

            $montant_disponible = '';
            if($project->Statut_1_hyphen_MyMPR == 'Demande de solde' && $project->Statut_2_hyphen_MyMPR == 'Acceptée pour paiement'){
                $montant_disponible = EuroFormat(20000 - $project->Montant_subvention_prévisionnel_hyphen_MyMPR);
            }

            return response()->json(['mpr_file' =>$project->N_Dossier_MPR_hyphen_MyMPR, 'address' => $project->Adresse_hyphen_MyMPR, 'status_1'=> $project->Statut_1_hyphen_MyMPR, 'status_2' => $project->Statut_2_hyphen_MyMPR, 'deposit_date' => $project->Date_de_dépôt_MyMPR, 'estimated_amount' =>  $project->Montant_subvention_prévisionnel_hyphen_MyMPR, 'updated_at' => Carbon::parse($project->mpr_updated_at)->format('d/m/Y, H:i'), 'montant_disponible' => $montant_disponible]);
    }
}
