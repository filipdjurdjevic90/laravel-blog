<div id="index-slider" class="owl-carousel">
    
    @foreach($indexSliders as $indexSlider)
    <section style="background: url('{{$indexSlider->getPhotoUrl()}}'); background-size: cover; background-position: center center" class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h1>{{$indexSlider->headline}}</h1>
                    <a href="{{$indexSlider->link}}" class="hero-link">{{$indexSlider->name}}</a>
                </div>
            </div>
        </div>
    </section>
    
    @endforeach
    
</div>
