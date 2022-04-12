<?php

namespace App\Services;

use App\Models\Composition;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class CompositionSortService
{
    private $column;
    private $current_page;
    private $direction;
    private $paginator;
    private $path;
    private $per_page;
    private $query;
    private $request;
    private $compositions;
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
        $this->compositions = collect();
        $this->starting_point = 0;

        $this->parseRequest();
        $this->selectSortType();
        $this->stripCompositions();
    }

    /**
     * Return a custom paginator for compositions in various sort orders
     */
    public function sort()
    {
        return $this->compositions;
    }

    private function selectSortType()
    {
        if((! strlen($this->column)) || ($this->column === 'titles')){

            ($this->direction === 'asc') ? $this->sortAlpha() : $this->sortAlphaReverse();

        }else{

            $method = 'sort'.ucfirst($this->column).ucfirst($this->direction);
            $this->$method();
        }
    }

    private function stripCompositions()
    {
        foreach($this->paginator->items() AS $item){

            $this->compositions->push($item['composition']);
        }
    }

    private function sortAlpha()
    {
        $raw = [];

        foreach(Composition::orderBy('title')->get() AS $composition){

            $raw[] = [
                'sort' => $composition->title,
                'composition' => $composition,
            ];
        }

        $array = array_slice($raw, $this->starting_point, $this->per_page, true);

        $this->paginator = new Paginator($array, $this->per_page, $this->current_page, ['path' => $this->path, 'query' => $this->query]);
    }

    private function sortAlphaReverse()
    {
        $raw = [];

        foreach(Composition::orderByDesc('title')->get() AS $composition){

            $raw[] = [
                'sort' => $composition->title,
                'composition' => $composition,
            ];
        }

        $array = array_slice($raw, $this->starting_point, $this->per_page, false);

        $this->paginator = new Paginator($array, $this->per_page, $this->current_page, ['path' => $this->path, 'query' => $this->query]);
    }

    private function sortPerformedAsc()
    {
        $raw = [];

        foreach(Composition::orderByDesc('title')->get() AS $composition){

            $raw[] = [
                'sort' => $composition->performanceCount,
                'composition' => $composition,
            ];
        }

        sort($raw);

        $array = array_slice($raw, $this->starting_point, $this->per_page, true);

        $this->paginator = new Paginator($array, $this->per_page, $this->current_page, ['path' => $this->path, 'query' => $this->query]);
    }

    private function sortPerformedDesc()
    {
        $raw = [];

        //pull all compositions
        foreach(Composition::orderByDesc('title')->get() AS $composition){

            $raw[] = [
                'sort' => $composition->performanceCount,
                'composition' => $composition,
            ];
        }

        //break $raw into independently sortable segments
        $years = [];
        $titles = [];
        foreach($raw AS $key => $row){
            $years[$key] = $row['sort'];
            $titles[$key] = $row['composition'];
        }

        //sort years descending, names ascending
        array_multisort($years, SORT_DESC, SORT_NUMERIC, $titles, SORT_ASC, SORT_STRING, $raw);

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
