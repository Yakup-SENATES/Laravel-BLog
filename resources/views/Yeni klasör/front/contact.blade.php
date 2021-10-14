@extends('front.layouts.master')

@section('title', 'Title test')

@section('image','https://startbootstrap.github.io/startbootstrap-clean-blog/assets/img/contact-bg.jpg')
	
@section('content')
                    {{--form kısmı--}}
                    <div class="col-md-8">
                        

                        <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
                        <div class="my-5">
                         
                            <form method="POST" action="{{ route('contact.post') }}">
                                @csrf

                                @if (session('success'))                                    
                                    <div class="alert alert-success">
                                      {{session('success')}}    
                                     </div> 
                                @endif

                             @if ($errors->any())                                 
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)                                           
                                        <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                             @endif


                                <div class="control-group">
                                    <label for="name">İsim Soyisim</label>                                    
                                    <input class="form-control" name="name" value="{{old('name')}}" required type="text" placeholder="Enter your name..." data-sb-validations="required" />
                                </div>
								
								<br>

                                <div class="control-group">
                                    <label for="email">Email address</label>
                                    <input class="form-control" name="email" value="{{old('email')}}" type="email" placeholder="Enter your email..." required />
                                </div>
								
								<br>

                                <div class="control-group">
                                    <label>Başlık</label>
									<select class="form-control" name="topic">
										<option @if (old('topic')=="Bilgi") selected  @endif>Bilgi</option>
										<option @if (old('topic')=="Destek") selected  @endif>Destek</option>
										<option @if (old('topic')=="Genel")  selected @endif>Genel</option>

									</select>
								</div>
								<br>
                                
								
								<div class="control-group">
                                    <textarea class="form-control" name="message" placeholder="Enter your message here..." style="height: 12rem">{{old('message')}}</textarea>
                                    <label for="message">Mesajınız</label>
                                </div>
                                <br />
                             
								<!-- Submit Button-->
                                <button class="btn btn-primary text-uppercase" name="submit" type="submit">Gönder</button>
                            </form>
                        </div>
                    </div>  

					<div class="col-md-4">
                        <div class=" card">
                            <div class="card-header">
                                Panel Content
                            </div>
                            <div class="card-body">
                          Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis, dignissimos voluptas nesciunt aspernatur unde, sed quia nam eaque cupiditate placeat quod eos repellendus dolores vel recusandae, totam architecto dolorum modi.
                            </div>
                        </div>



						<!--Google map-->
						<div id="map-container-google-2" class="z-depth-1-half map-container" style="height: 300px ; width: 450px">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24054.289088332032!2d28.97413735988553!3d41.09551917467263!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cab684450e734f%3A0xb4b6e8b206dd8382!2zU2V5cmFudGVwZSwgMzQ0MTggS8OixJ_EsXRoYW5lL8Swc3RhbmJ1bA!5e0!3m2!1str!2str!4v1631573508738!5m2!1str!2str" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
						</div>                       
						<!--Google Maps-->
                    </div>        
    
@endsection
      
