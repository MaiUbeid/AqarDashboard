
<div class="radio-container">
    <h3>Ready To Download</h3>
    <p>its simple , your image will start downlading once you chose your plan. owr worry-free standard license covers the most common uses of this image </p>
    <ul>
        <a href="" class="Buy-now"> {{trans('global.buynow')}}</a>
        @foreach($image_plans as $image_plan)
        <li>
            <input type="radio" id="z-option" name="selector">
            <label for="z-option"><p class="label-p">{{$image_plan->downloads_count}} images <br> <span class="label-spn2">${{$image_plan->price}}</span></p> <p class="label-p2">${{number_format($image_plan->price/$image_plan->downloads_count,2,'.','')}}  <br><span class="label-p2-spn1">Per image</span></p></label>

            <div class="check"></div>
        </li>
        @endforeach
        <a href="" class="annula">Annual plan</a>
        @foreach($plans as $plan)
        <li>
            <input required type="radio" id="f-option" value="{{$plan->id}}" name="selector">
            <label for="f-option"><p class="label-p">{{$plan->downloads_count}} images <span class="label-spn1">/mo</span> <br> <span class="label-spn2">${{$plan->price}}/mo</span></p> <p class="label-p2">
                    ${{number_format($plan->price/$plan->downloads_count,2,'.','')}} <br>
                    <span class="label-p2-spn1">Per image</span></p></label>

            <div class="check"></div>

        </li>
        @endforeach
    </ul>
</div>
