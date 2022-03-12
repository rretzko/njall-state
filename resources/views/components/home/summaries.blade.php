<div id="summaries" style=" display: flex; justify-content: space-between; margin: 2rem;">
    <style>
        .summary-card{
            background-color: rgba(113,128,150,0.1);
            border: 1px solid lightgrey;
            display: flex;
            flex-direction: column;
            margin-right: 0.25rem;
            padding: 1rem;
            justify-content: center;
            width: 100%;
        }
        .summary-card header{
            font-weight: bold;
        }
        .summary-card header, .summary-card data{
            text-align: center;
        }
    </style>
    <div class="summary-card">
        <header>
            Years
        </header>
        <data>
            {{ \App\Models\Event::all()->count() }}
        </data>
    </div>

    <div class="summary-card">
        <header>
            Conductors
        </header>
        <data>
            {{ number_format(\App\Models\Conductor::all()->count(),0) }}
        </data>
    </div>

    <div class="summary-card">
        <header>
            Participants
        </header>
        <data>
            {{ number_format(\App\Models\Participant::all()->count(),0) }}
        </data>
    </div>

    <div class="summary-card">
        <header>
            Schools
        </header>
        <data>
            {{ number_format(\App\Models\School::all()->count(),0) }}
        </data>
    </div>

    <div class="summary-card">
        <header>
            Titles
        </header>
        <data>
            {{ number_format(\App\Models\Composition::all()->count(),0) }}
        </data>
    </div>

</div>
