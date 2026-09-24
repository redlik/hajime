{{--
    Shared qualification-level <option> list, included both by the "add new" form
    and the edit modal for each of the Referee / Table Official / Coach tabs.

    Expects:
      $type      - 'referee' | 'table_official' | 'coach'
      $selected  - the currently-selected value (string) or null

    NOTE: the 11 named Referee grades below are confirmed by IJA (CR26-001 / R1).
--}}
<option value="" @selected(!$selected) disabled>Select qualification level</option>

@if ($type === 'referee')
    <option value='National "C" Trainee' @selected($selected == 'National "C" Trainee')>National "C" Trainee</option>
    <option value='National "C"' @selected($selected == 'National "C"')>National "C"</option>
    <option value='National "B"' @selected($selected == 'National "B"')>National "B"</option>
    <option value='National "A"' @selected($selected == 'National "A"')>National "A"</option>
    <option value='Senior IJA Referee' @selected($selected == 'Senior IJA Referee')>Senior IJA Referee</option>
    <option value='National "A" and IJF Honorary Referee' @selected($selected == 'National "A" and IJF Honorary Referee')>National "A" and IJF Honorary Referee</option>
    <option value='IJF Continental Referee "B"' @selected($selected == 'IJF Continental Referee "B"')>IJF Continental Referee "B"</option>
    <option value='IJF International "B" Referee' @selected($selected == 'IJF International "B" Referee')>IJF International "B" Referee</option>
    <option value='IJF International "A" Referee' @selected($selected == 'IJF International "A" Referee')>IJF International "A" Referee</option>
    <option value='IJF Honorary Referee' @selected($selected == 'IJF Honorary Referee')>IJF Honorary Referee</option>
    <option value='Other National Federation referee' @selected($selected == 'Other National Federation referee')>Other National Federation referee</option>
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
