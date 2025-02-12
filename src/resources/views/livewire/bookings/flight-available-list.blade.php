<div>
   @foreach($flights as $flight)
         <span >{{ $flight->departure_airport. ' => '. $flight->arrival_airport}}</span>
   @endforeach   
</div>
