<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class History extends Application
{
    private $items_per_page = 10;


    public function __construct() {
        parent::__construct();
        $this->load->model('transaction');
    }

    public function index()
    {
            error_reporting(E_ALL ^ E_WARNING);
            $this->page(1);
    }


    // Show a single page of todo items
    private function show_page($transactions)
        {
        $this->data['pagetitle'] = 'Jambul History';
        // build the transaction presentation output
        $result = ''; // start with an empty array      
        foreach ($transactions as $trans) {
                $result .= $this->parser->parse('oneTransaction', (array) $trans, true);
        }
        $this->data['display_transactions'] = $result;

        // and then pass them on
        $this->data['pagebody'] = 'history';
        $this->render();
    }


    // Extract & handle a page of items, defaulting to the beginning
    function page($num = 1)
    {
        $records = $this->transaction->all(); // get all the transactions
        $transactions = array(); // start with an empty extract

        // use a foreach loop, because the record indices may not be sequential
        $index = 0; // where are we in the transactionss list
        $count = 0; // how many items have we added to the extract
        $start = ($num - 1) * $this->items_per_page;
        foreach($records as $trans) {
            if ($index++ >= $start) {
                $transactions[] = $trans;
                $count++;
            }
            if ($count >= $this->items_per_page) break;
        }
        $this->data['pagination'] = $this->pagenav($num);
        $this->show_page($transactions);
    }



    // Build the pagination navbar
    private function pagenav($num) {
        $lastpage = ceil($this->transaction->size() / $this->items_per_page);
        $parms = array(
        'first' => 1,
        'previous' => (max($num-1,1)),
        'next' => min($num+1,$lastpage),
        'last' => $lastpage
        );
        return $this->parser->parse('itemnav',$parms,true);
    }


}
