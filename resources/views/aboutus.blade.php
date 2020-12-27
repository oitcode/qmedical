<div>
  <h1>Hello World</h1>

  @foreach ($clientTestimonials as $testimonial)
    <div>
      {{ $testimonial->client_name }}
    </div>
  @endforeach

  <form method="POST" action="/clienttestimonial">
    @csrf
    <input type="text" name="clientName" />
    <button type="submit">
      Submit
    </button>
  </form>

</div>
