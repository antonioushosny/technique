<?php

namespace Modules\Admin\Exports;

use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

 

class AdminClientsExport implements FromView, Responsable
{


    use Exportable;
    
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName =	'clients.xlsx';
    
    /**
    * Optional Writer Type
    */
    private $writerType = Excel::XLSX;
    
    /**
    * Optional headers
    */
    // private $headers = [
    //     'Content-Type' => 'text/csv',
    

	// ];
	public function __construct( $clients)
    {
        $this->clients = $clients;
    }

    public function view(): View
    {
        return view('admin::front.exports.adminclients', [
            'clients' => $this->clients ,
        ]);
    }

    
}
