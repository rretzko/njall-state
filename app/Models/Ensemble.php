<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ensemble extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public $table = 'ensembles';

    public $orderable = [
        'id',
        'name',
    ];

    public $filterable = [
        'id',
        'name',
    ];

    protected $fillable = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function instrumentations()
    {
        return $this->belongsToMany(Instrumentation::class)->orderBy('order_by');
    }

    public function participantsByInstrumentation(Event $event, Instrumentation $instrumentation)
    {
        return Participant::where('event_id', $event->id)
            ->where('ensemble_id', $this->id)
            ->where('instrumentation_id', $instrumentation->id)
            ->orderBy('last')
            ->get();
    }

    public function participantsByInstrumentationBlocks(Event $event, Instrumentation $instrumentation, $count)
    {
        $str = '<div class="mb-4 px-2 shadow-lg" style="margin-right: 1rem; border-right: 1px solid darkgrey border-bottom: 1px solid darkgrey; width: 20rem;">';
        $cntr = 1;

        foreach($this->participantsByInstrumentation($event, $instrumentation) AS $participant){

            $label = $participant->fullnameAlpha.' ('.$participant->school->name.')';

            $display = (strlen($label) > 35) ? trim(substr($label,0,32)).'...' : $label;

            $str .= '<div class="text-left" title="'.$label.'">'.$display.'</div>';

            if(! ($cntr % $count)){
                $str .= '</div>
                    <div class="mb-4 px-2 shadow-lg w-auto" style="margin-right: 1rem; border-right: 1px solid darkgrey border-bottom: 1px solid darkgrey; width: 20rem;">';
            }

            $cntr++;
        }

        $str .= '</div>';

        return $str;
    }

    public function participantsByInstrumentationCount(Event $event, Instrumentation $instrumentation)
    {
        return Participant::where('event_id', $event->id)
            ->where('ensemble_id', $this->id)
            ->where('instrumentation_id', $instrumentation->id)
            ->orderBy('last')
            ->count('id');
    }

    public function participantsCount(Event $event)
    {
        return Participant::where('event_id', $event->id)
            ->where('ensemble_id', $this->id)
            ->count('id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
