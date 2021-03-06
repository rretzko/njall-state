<?php

namespace App\Services;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class SchoolSortService
{
    private $column;
    private $current_page;
    private $direction;
    private $paginator;
    private $path;
    private $per_page;
    private $query;
    private $request;
    private $schools;
    private $starting_point;

    public function __construct(Request $request)
    {
        $this->column = '';
        $this->current_page = 1;
        $this->direction = 'asc';
        $this->paginator = NULL;
        $this->path = '';
        $this->per_page = 20;
        $this->query = '';
        $this->request = $request;
        $this->schools = collect();
        $this->starting_point = 0;

        $this->parseRequest();
        $this->selectSortType();
        $this->stripSchools();
    }

    /**
     * Return a custom paginator for schools in various sort orders
     */
    public function sort()
    {
        return $this->schools;
    }

    private function selectSortType()
    {
        if((! strlen($this->column)) || ($this->column === 'name')){

            ($this->direction === 'asc') ? $this->sortAlpha() : $this->sortAlphaReverse();

        }else{

            $method = 'sort'.ucfirst($this->column).ucfirst($this->direction);
            $this->$method();
        }
    }

    private function stripSchools()
    {
        foreach($this->paginator->items() AS $item){

            $this->schools->push($item['school']);
        }
    }

    private function sortAlpha()
    {
        $raw = [];

        foreach(School::all() AS $school){

            $raw[] = [
                'sort' => $school->name,
                'school' => $school,
            ];
        }

        sort($raw);

        $array = array_slice($raw, $this->starting_point, $this->per_page, true);

        $this->paginator = new Paginator($array, $this->per_page, $this->current_page, ['path' => $this->path, 'query' => $this->query]);
    }

    private function sortAlphaReverse()
    {
        $raw = [];

        foreach(School::all() AS $school){

            $raw[] = [
                'sort' => $school->name,
                'school' => $school,
            ];
        }

        rsort($raw);

        $array = array_slice($raw, $this->starting_point, $this->per_page, false);

        $this->paginator = new Paginator($array, $this->per_page, $this->current_page, ['path' => $this->path, 'query' => $this->query]);
    }

    private function sortStudentsAsc()
    {
        $raw = [];

        foreach(School::all() as $school){

            $raw[] =[
              'sort' => $school->studentsCount,
              'name' => $school->name,
              'school' => $school,
            ];
        }

        sort($raw);

        $array = array_slice($raw, $this->starting_point, $this->per_page, true);

        $this->paginator = new Paginator($array, $this->per_page, $this->current_page, ['path' => $this->path, 'query' => $this->query]);
    }

    private function sortStudentsDesc()
    {
        $raw = [];

        //pull all schools
        foreach(School::all() as $school){

            $raw[] =[
                'sort' => $school->studentsCount,
                'name' => $school->name,
                'school' => $school,
            ];
        }

        //break $raw into independently sortable segments
        $years = [];
        $names = [];
        foreach($raw AS $key => $row){
            $years[$key] = $row['sort'];
            $names[$key] = $row['name'];
        }

        //sort years descending, names ascending
        array_multisort($years, SORT_DESC, SORT_NUMERIC, $names, SORT_ASC, SORT_STRING, $raw);

        //pull appropriate slide of sorted array
        $array = array_slice($raw, $this->starting_point, $this->per_page, true);

        //create paginator
        $this->paginator = new Paginator($array, $this->per_page, $this->current_page, ['path' => $this->path, 'query' => $this->query]);
    }

    private function sortYearsAsc()
    {
        $raw = [];

        foreach(School::all() as $school){

            $raw[] =[
                'sort' => $school->yearsCount,
                'name' => $school->name,
                'school' => $school,
            ];
        }

        sort($raw);

        $array = array_slice($raw, $this->starting_point, $this->per_page, true);

        $this->paginator = new Paginator($array, $this->per_page, $this->current_page, ['path' => $this->path, 'query' => $this->query]);
    }

    private function sortYearsDesc()
    {
        $raw = [];

        //pull all schools
        foreach(School::all() as $school){

            $raw[] =[
                'sort' => $school->yearsCount,
                'name' => $school->name,
                'school' => $school,
            ];
        }

        //break $raw into independently sortable segments
        $years = [];
        $names = [];
        foreach($raw AS $key => $row){
            $years[$key] = $row['sort'];
            $names[$key] = $row['name'];
        }

        //sort years descending, names ascending
        array_multisort($years, SORT_DESC, SORT_NUMERIC, $names, SORT_ASC, SORT_STRING, $raw);

        //pull appropriate slide of sorted array
        $array = array_slice($raw, $this->starting_point, $this->per_page, true);

        //create paginator
        $this->paginator = new Paginator($array, $this->per_page, $this->current_page, ['path' => $this->path, 'query' => $this->query]);
    }

    private function parseRequest()
    {
        $this->column = (isset($this->request['column'])) ? $this->request['column'] : false;
        $this->current_page = $this->request->input("page") ?? 1;
        $this->direction = ($this->request->input('direction') === 'asc') ? 'desc' : 'asc';
        $this->path = $this->request->url();
        $this->query = $this->request->query();
        $this->starting_point = ($this->current_page * $this->per_page) - $this->per_page;
    }

}
