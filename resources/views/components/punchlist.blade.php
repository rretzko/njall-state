<style>
    ul{margin-left: 2rem;}
</style>
<div id="punchlist">
    <h5>Punchlist</h5>
    <ul>
        <!-- {{--
        <li>Compositions
            <ul>
                <li>Title</li>
                <li>Subtitle</li>
            </ul></li>
            --}} -->
        <li>Composition_Event
            <ul>
                <li>event_id</li>
                <li>composition_id</li>
                <li>opener</li>
                <li>closer</li>
                <li>combined</li>
                <li>order_by</li>
            </ul></li>
        <li>Artist
            <ul>
                <li>first</li>
                <li>last</li>
            </ul></li>
        <li>artist_artisttype
            <ul>
                <li>artist_id</li>
                <li>artisttype_id</li>
            </ul>
        </li>
        <li>artist_composition
            <ul>
                <li>artist_id</li>
                <li>composition_id</li>
                <li>artisttype_id</li>
            </ul></li>
        <li>Conductors
            <ul>
                <li>name</li>
                <li>first</li>
                <li>last</li>
            </ul></li>
        <li>conductor_event
            <ul>
                <li>conductor_id</li>
                <li>event_id</li>
            </ul></li>
    </ul>
</div>