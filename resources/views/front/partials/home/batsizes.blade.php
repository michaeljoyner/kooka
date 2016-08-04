<div class="mobile-table-key">
    <span>Player Height</span>|<span>Bat Size</span>
</div>
<table class="bat-size-table">
    <tbody>
    <tr class="bat-img-row">
        {{--<td class="first-col"></td>--}}
        @foreach(range(1,11) as $index)
            <td class="bat-size-bat-{{ $index }} bat-size-bat">
                <img src="/images/assets/bat_size.svg" alt="bat size icon">
            </td>
        @endforeach
    </tr>
    <tr class="label-row">
        <td colspan="11">Player height</td>
    </tr>
    <tr class="info-row">
        {{--<td class="first-col">Height of Player</td>--}}
        <td>- 4ft</td>
        <td>4ft 3"</td>
        <td>4ft 6"</td>
        <td>4ft 9"</td>
        <td>5ft 0"</td>
        <td>5ft 3"</td>
        <td>5ft 5"</td>
        <td>5ft 7"</td>
        <td>5ft 9"</td>
        <td>6ft" 0"</td>
        <td>6ft +</td>
    </tr>
    <tr class="label-row">
        <td colspan="11">Bat Size</td>
    </tr>
    <tr class="info-row">
        {{--<td class="first-col">Bat Size</td>--}}
        <td>0</td>
        <td>1</td>
        <td>2</td>
        <td>3</td>
        <td>4</td>
        <td>5</td>
        <td>6</td>
        <td>H</td>
        <td>SM</td>
        <td>SH</td>
        <td>LH/LB</td>
    </tr>
    </tbody>
</table>