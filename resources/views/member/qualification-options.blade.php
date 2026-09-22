{{--
    Shared qualification-level <option> list, included both by the "add new" form
    and the edit modal for each of the Referee / Table Official / Coach tabs.

    Expects:
      $type      - 'referee' | 'table_official' | 'coach'
      $selected  - the currently-selected value (string) or null

    NOTE: the 11 named Referee grades below are a placeholder pending confirmation
    from IJA (CR26-001 / Request 1 only specifies "11 named refereeing grades +
    Other", not the exact names). Update this list once confirmed - it is the only
    place the option list needs to change.
--}}
<option value="" @selected(!$selected) disabled>Select qualification level</option>

@if ($type === 'referee')
    <option value="Club Referee" @selected($selected == 'Club Referee')>Club Referee</option>
    <option value="Regional Referee" @selected($selected == 'Regional Referee')>Regional Referee</option>
    <option value="National C" @selected($selected == 'National C')>National C</option>
    <option value="National B" @selected($selected == 'National B')>National B</option>
    <option value="National A" @selected($selected == 'National A')>National A</option>
    <option value="Candidate International" @selected($selected == 'Candidate International')>Candidate International</option>
    <option value="International B" @selected($selected == 'International B')>International B</option>
    <option value="International A" @selected($selected == 'International A')>International A</option>
    <option value="IJF Continental Open" @selected($selected == 'IJF Continental Open')>IJF Continental Open</option>
    <option value="IJF Referee" @selected($selected == 'IJF Referee')>IJF Referee</option>
    <option value="IJF Referee A" @selected($selected == 'IJF Referee A')>IJF Referee A</option>
    <option value="Other" @selected($selected == 'Other')>Other</option>
@elseif ($type === 'table_official')
    <option value="Level 1" @selected($selected == 'Level 1')>Level 1</option>
    <option value="Level 2" @selected($selected == 'Level 2')>Level 2</option>
    <option value="Other" @selected($selected == 'Other')>Other</option>
@elseif ($type === 'coach')
    <option value="Level 0" @selected($selected == 'Level 0')>Level 0</option>
    <option value="Level 1" @selected($selected == 'Level 1')>Level 1</option>
    <option value="Level 2" @selected($selected == 'Level 2')>Level 2</option>
    <option value="Level 3" @selected($selected == 'Level 3')>Level 3</option>
    <option value="Level 4" @selected($selected == 'Level 4')>Level 4</option>
    <option value="IJF UCJI" @selected($selected == 'IJF UCJI')>IJF UCJI</option>
    <option value="IJF UDJC" @selected($selected == 'IJF UDJC')>IJF UDJC</option>
    <option value="Other" @selected($selected == 'Other')>Other</option>
@endif
