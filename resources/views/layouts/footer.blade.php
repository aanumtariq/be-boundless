<!-------------- footer sec start ------------->
<!-- Footer -->
<section class="foot">
    <div class="footer">   
        <div class="logo_foot">
            
            <ul>    
                <img src="{{ asset('images/logo.png') }}" alt="logo" class="logo-img footer-logo">
                
                <li class="quik-link">
                    <a href="{{ url('index') }}">Home</a>
                </li>
                <li class="quik-link">
                    <a href="{{ url('about') }}">About us</a>
                </li>
                <li class="quik-link">
                    <a href="{{ url('articals') }}">Articals</a>
                </li>
                
                <li class="quik-link">
                    <a href="{{ url('packages') }}">Packges</a>
                </li>               
                <li class="quik-link">
                    <a href="{{ url('index') }}#sec5">Contact</a>
                </li> 
            </ul>
            
        </div>
        <div class="time_foot">
            <h3 class="opn_time footer-head">OPENING TIME</h3>

            <h5 class="time_text footer-text">MONDAY.......9:00-22:00</h5>
            <h5 class="time_text footer-text">TUESDAY.......9:00-22:00</h5>
            <h5 class="time_text footer-text">WEDNESDAY.......9:00-22:00</h5>
            <h5 class="time_text footer-text">THURSADAY.......9:00-22:00</h5>
            <h5 class="time_text footer-text">FRIDAY.......9:00-20:00</h5>
            <h5 class="time_text footer-text">SATURDAY.......9:00-22:00</h5>
            <h5 class="time_text footer-text">SUNDAY.......0FF</h5>
        </div>

        <div class="loc_foot">
            <h3 class="loc_head footer-head">Our Location</h3>
            <h5 class="loc_text footer-text">
                {{ $config['ADDRESS'] }}
            </h5>                       
            <iframe width="300" height="170" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"  
            src="https://maps.google.com/maps?q={{ $config['LATITUDE'] }},{{ $config['LONGITUDE'] }}&hl=es&z=14&amp;output=embed"></iframe>
            
        </div>

        
    </div>
</section>
