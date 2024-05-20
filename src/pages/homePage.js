 import axios from "axios";
const homePage = ()=>{
$(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        axios.get('http://localhost:8000/api/home')
                .then(function(response) {
                  if(response.status){
                    $.each(response.data.data, function(index,items){
            
                      let row = `<div class="col-md-6 col-lg-4" data-aos="fade-up">
                      <a href="#" class="room">
                        <figure class="img-wrap">
                          <img src="images/bac-me-ha-giang.png" alt="Free website template" class="img-fluid mb-3">
                        </figure>
                        <div class="p-3 text-center room-info">
                          <h2> ${items.starting_name} <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                        </svg> ${items.destination_name}</h2>
                         
                          <div class="d-flex " style="gap:30px">
                          <h5><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                        </svg> ${items.departure_time}</h5>

                        <h5><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bus-front" viewBox="0 0 16 16">
                        <path d="M5 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0m8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-6-1a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2zm1-6c-1.876 0-3.426.109-4.552.226A.5.5 0 0 0 3 4.723v3.554a.5.5 0 0 0 .448.497C4.574 8.891 6.124 9 8 9s3.426-.109 4.552-.226A.5.5 0 0 0 13 8.277V4.723a.5.5 0 0 0-.448-.497A44 44 0 0 0 8 4m0-1c-1.837 0-3.353.107-4.448.22a.5.5 0 1 1-.104-.994A44 44 0 0 1 8 2c1.876 0 3.426.109 4.552.226a.5.5 0 1 1-.104.994A43 43 0 0 0 8 3"/>
                        <path d="M15 8a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1V2.64c0-1.188-.845-2.232-2.064-2.372A44 44 0 0 0 8 0C5.9 0 4.208.136 3.064.268 1.845.408 1 1.452 1 2.64V4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1v3.5c0 .818.393 1.544 1 2v2a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5V14h6v1.5a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-2c.607-.456 1-1.182 1-2zM8 1c2.056 0 3.71.134 4.822.261.676.078 1.178.66 1.178 1.379v8.86a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 11.5V2.64c0-.72.502-1.301 1.178-1.379A43 43 0 0 1 8 1"/>
                      </svg>${items.kilometer}.kilometer</h5>
                          </div>
                        </div>
                      </a>
                    </div>`
                    $("#tickets").append(row);
                    })
                    $.each(response.data.starting_point,function(index,items){
                  
                       let row = `<option value="${items.starting_id}"> ${items.starting_name}</option>`
                       $("#starting_point").append(row)
                    }); 
                    $.each(response.data.destination_point,function(index,items){
                   
                       let row = `<option value="${items.destination_id}"> ${items.destination_name}</option>`
                       $("#destination_point").append(row)
                    });
                  }
                })
                .catch(function(error) {
                    console.error('Error:', error); // Xử lý lỗi nếu có
                });
});

    return `<section class="site-hero overlay" style="background-image: url(images/hero_4.jpg)" data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row site-hero-inner justify-content-center align-items-center">
        <div class="col-md-10 text-center" data-aos="fade-up">
          <span class="custom-caption text-uppercase text-white d-block  mb-3">Welcome To 5 <span class="fa fa-star text-primary"></span>   Hotel</span>
          <h1 class="heading">A Best Place To Stay</h1>
        </div>
      </div>
    </div>
    <a class="mouse smoothscroll" href="#next">
      <div class="mouse-icon">
        <span class="mouse-wheel"></span>
      </div>
    </a>
  </section>
  <!-- END section -->

  <section class="section bg-light pb-0"  >
    <div class="container">
     
      <div class="row check-availabilty" id="next">
        <div class="block-32" data-aos="fade-up" data-aos-offset="-200">

        <form action="#">
        <div class="row">
          <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
            <label for="checkin_date" class="font-weight-bold text-black">Chọn nơi đi</label>
            <div class="field-icon-wrap">
              <div class="icon"><span class="icon-calendar"></span></div>
               <select name="starting_point_id" id="starting_point" class="form-control">

               </select>
            </div>
          </div>
          <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
            <label for="checkout_date" class="font-weight-bold text-black">Chọn nơi đến</label>
            <div class="field-icon-wrap">
              <div class="icon"><span class="icon-calendar"></span></div>
              <select name="destination_point_id" id="destination_point" class="form-control">

              </select>
            </div>
          </div>
          <div class="col-md-12 mb-3 mb-md-0 col-lg-3">
            <div class="row">
              <div class="col-md-12 mb-3 mb-md-0">
                <label for="adults" class="font-weight-bold text-black">Chọn ngày</label>
                <div class="field-icon-wrap">
                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                  <input type="datetime-local" class="form-control" name="date">
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 align-self-end">
            <button class="btn btn-primary btn-block text-white">Tìm kiếm</button>
          </div>
        </div>
      </form>
        </div>


      </div>
    </div>
  </section>

  <section class="py-5 bg-light">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-12 col-lg-7 ml-auto order-lg-2 position-relative mb-5" data-aos="fade-up">
          <figure class="img-absolute">
            <img src="images/food-1.jpg" alt="Image" class="img-fluid">
          </figure>
          <img src="images/banner_wellcom.jpg" alt="Image" class="img-fluid rounded">
        </div>
        <div class="col-md-12 col-lg-4 order-lg-1" data-aos="fade-up">
          <h2 class="heading">Welcome!</h2>
          <p class="mb-4">Booking Group – thương hiệu vận tải của người Tây Bắc. Chúng tôi ra đời với sứ mệnh tạo ra sự thuận tiện, an toàn, chuyên nghiệp cho quý khách hàng di chuyển trên lộ trình Hà Nội – Tuyên Quang – Hà Giang – Cao Bằng – Lào Cai. Vũ Hán Group không ngừng cải tiến chất lượng dịch vụ giúp khách hàng có những trải nghiệm tốt nhất.</p>
          <p><a href="#" class="btn btn-primary text-white py-2 mr-3">Đặt Vé </a> <span class="mr-3 font-family-serif"><em>or</em></span> <a href="https://vimeo.com/channels/staffpicks/93951774"  data-fancybox class="text-uppercase letter-spacing-1">See video</a></p>
        </div>
        
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="row justify-content-center text-center mb-5">
        <div class="col-md-7">
          <h2 class="heading" data-aos="fade-up">Các cung đường</h2>
          <p data-aos="fade-up" data-aos-delay="100">Hệ thống dòng xe Giường nằm, Limousine hiện đại nhất trên tuyến. Đem lại sự sang trọng và đầy đủ tiện ích như loại da cao cấp, màn hình riêng, tai nghe, nước uống, chăn đắp, đèn đọc sách và rèm cửa.</p>
        </div>
      </div>
      <div class="row" id="tickets">
       

      </div>
    </div>
  </section>
  
  
  <section class="section slider-section bg-light">
    <div class="container">
      <div class="row justify-content-center text-center mb-5">
        <div class="col-md-7">
          <h2 class="heading" data-aos="fade-up">Photos</h2>
          <p data-aos="fade-up" data-aos-delay="100">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="home-slider major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
            <div class="slider-item">
              <a href="images/slider-1.jpg" data-fancybox="images" data-caption="Caption for this image"><img src="images/slider-1.jpg" alt="Image placeholder" class="img-fluid"></a>
            </div>
            <div class="slider-item">
              <a href="images/slider-2.jpg" data-fancybox="images" data-caption="Caption for this image"><img src="images/slider-2.jpg" alt="Image placeholder" class="img-fluid"></a>
            </div>
            <div class="slider-item">
              <a href="images/slider-3.jpg" data-fancybox="images" data-caption="Caption for this image"><img src="images/slider-3.jpg" alt="Image placeholder" class="img-fluid"></a>
            </div>
            <div class="slider-item">
              <a href="images/slider-4.jpg" data-fancybox="images" data-caption="Caption for this image"><img src="images/slider-4.jpg" alt="Image placeholder" class="img-fluid"></a>
            </div>
            <div class="slider-item">
              <a href="images/slider-5.jpg" data-fancybox="images" data-caption="Caption for this image"><img src="images/slider-5.jpg" alt="Image placeholder" class="img-fluid"></a>
            </div>
            <div class="slider-item">
              <a href="images/slider-6.jpg" data-fancybox="images" data-caption="Caption for this image"><img src="images/slider-6.jpg" alt="Image placeholder" class="img-fluid"></a>
            </div>
            <div class="slider-item">
              <a href="images/slider-7.jpg" data-fancybox="images" data-caption="Caption for this image"><img src="images/slider-7.jpg" alt="Image placeholder" class="img-fluid"></a>
            </div>
          </div>
          <!-- END slider -->
        </div>
      
      </div>
    </div>
  </section>
  <!-- END section -->
  
  <section class="section bg-image overlay" style="background-image: url('images/hero_3.jpg');">
    <div class="container">
      <div class="row justify-content-center text-center mb-5">
        <div class="col-md-7">
          <h2 class="heading text-white" data-aos="fade">Our Restaurant Menu</h2>
          <p class="text-white" data-aos="fade" data-aos-delay="100">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
        </div>
      </div>
      <div class="food-menu-tabs" data-aos="fade">
        <ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active letter-spacing-2" id="mains-tab" data-toggle="tab" href="#mains" role="tab" aria-controls="mains" aria-selected="true">Mains</a>
          </li>
          <li class="nav-item">
            <a class="nav-link letter-spacing-2" id="desserts-tab" data-toggle="tab" href="#desserts" role="tab" aria-controls="desserts" aria-selected="false">Desserts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link letter-spacing-2" id="drinks-tab" data-toggle="tab" href="#drinks" role="tab" aria-controls="drinks" aria-selected="false">Drinks</a>
          </li>
        </ul>
        <div class="tab-content py-5" id="myTabContent">
          
          
          <div class="tab-pane fade show active text-left" id="mains" role="tabpanel" aria-labelledby="mains-tab">
            <div class="row">
              <div class="col-md-6">
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$20.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Murgh Tikka Masala</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$35.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Fish Moilee</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$15.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Safed Gosht</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$10.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">French Toast Combo</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$8.35</span>
                  <h3 class="text-white"><a href="#" class="text-white">Vegie Omelet</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$22.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Chorizo &amp; Egg Omelet</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
              </div>
            </div>
            

          </div> <!-- .tab-pane -->

          <div class="tab-pane fade text-left" id="desserts" role="tabpanel" aria-labelledby="desserts-tab">
            <div class="row">
              <div class="col-md-6">
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$11.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Banana Split</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$72.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Sticky Toffee Pudding</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$26.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Pecan</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$42.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Apple Strudel</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$7.35</span>
                  <h3 class="text-white"><a href="#" class="text-white">Pancakes</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$22.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Ice Cream Sundae</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
              </div>
            </div>
          </div> <!-- .tab-pane -->
          <div class="tab-pane fade text-left" id="drinks" role="tabpanel" aria-labelledby="drinks-tab">
            <div class="row">
              <div class="col-md-6">
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$32.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Spring Water</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$14.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Coke, Diet Coke, Coke Zero</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$93.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Orange Fanta</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$18.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Lemonade, Lemon Squash</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$38.35</span>
                  <h3 class="text-white"><a href="#" class="text-white">Sparkling Mineral Water</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$69.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Lemon, Lime &amp; Bitters</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
              </div>
            </div>
          </div> <!-- .tab-pane -->
        </div>
      </div>
    </div>
  </section>
  
  <!-- END section -->
  <section class="section testimonial-section">
    <div class="container">
      <div class="row justify-content-center text-center mb-5">
        <div class="col-md-7">
          <h2 class="heading" data-aos="fade-up">People Says</h2>
        </div>
      </div>
      <div class="row">
        <div class="js-carousel-2 owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
          
          <div class="testimonial text-center slider-item">
            <div class="author-image mb-3">
              <img src="images/design-30.png" alt="Image placeholder" class="rounded-circle mx-auto">
            </div>
            <blockquote>

              <p>&ldquo;A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.&rdquo;</p>
            </blockquote>
            <p><em>&mdash; Jean Smith</em></p>
          </div> 

          <div class="testimonial text-center slider-item">
            <div class="author-image mb-3">
              <img src="images/person_2.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
            </div>
            <blockquote>
              <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.&rdquo;</p>
            </blockquote>
            <p><em>&mdash; John Doe</em></p>
          </div>

          <div class="testimonial text-center slider-item">
            <div class="author-image mb-3">
              <img src="images/person_3.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
            </div>
            <blockquote>

              <p>&ldquo;When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane.&rdquo;</p>
            </blockquote>
            <p><em>&mdash; John Doe</em></p>
          </div>


          <div class="testimonial text-center slider-item">
            <div class="author-image mb-3">
              <img src="images/person_1.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
            </div>
            <blockquote>

              <p>&ldquo;A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.&rdquo;</p>
            </blockquote>
            <p><em>&mdash; Jean Smith</em></p>
          </div> 

          <div class="testimonial text-center slider-item">
            <div class="author-image mb-3">
              <img src="images/person_2.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
            </div>
            <blockquote>
              <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.&rdquo;</p>
            </blockquote>
            <p><em>&mdash; John Doe</em></p>
          </div>

          <div class="testimonial text-center slider-item">
            <div class="author-image mb-3">
              <img src="images/person_3.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
            </div>
            <blockquote>

              <p>&ldquo;When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane.&rdquo;</p>
            </blockquote>
            <p><em>&mdash; John Doe</em></p>
          </div>

        </div>
          <!-- END slider -->
      </div>

    </div>
  </section>
  

  <section class="section blog-post-entry bg-light">
    <div class="container">
      <div class="row justify-content-center text-center mb-5">
        <div class="col-md-7">
          <h2 class="heading" data-aos="fade-up">Events</h2>
          <p data-aos="fade-up">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 post" data-aos="fade-up" data-aos-delay="100">

          <div class="media media-custom d-block mb-4 h-100">
            <a href="#" class="mb-4 d-block"><img src="images/img_1.jpg" alt="Image placeholder" class="img-fluid"></a>
            <div class="media-body">
              <span class="meta-post">February 26, 2018</span>
              <h2 class="mt-0 mb-3"><a href="#">Travel Hacks to Make Your Flight More Comfortable</a></h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            </div>
          </div>

        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 post" data-aos="fade-up" data-aos-delay="200">
          <div class="media media-custom d-block mb-4 h-100">
            <a href="#" class="mb-4 d-block"><img src="images/img_2.jpg" alt="Image placeholder" class="img-fluid"></a>
            <div class="media-body">
              <span class="meta-post">February 26, 2018</span>
              <h2 class="mt-0 mb-3"><a href="#">5 Job Types That Aallow You To Earn As You Travel The World</a></h2>
              <p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 post" data-aos="fade-up" data-aos-delay="300">
          <div class="media media-custom d-block mb-4 h-100">
            <a href="#" class="mb-4 d-block"><img src="images/img_3.jpg" alt="Image placeholder" class="img-fluid"></a>
            <div class="media-body">
              <span class="meta-post">February 26, 2018</span>
              <h2 class="mt-0 mb-3"><a href="#">30 Great Ideas On Gifts For Travelers</a></h2>
              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. t is a paradisematic country, in which roasted parts of sentences.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section bg-image overlay" style="background-image: url('images/hero_4.jpg');">
      <div class="container" >
        <div class="row align-items-center">
          <div class="col-12 col-md-6 text-center mb-4 mb-md-0 text-md-left" data-aos="fade-up">
            <h2 class="text-white font-weight-bold">A Best Place To Stay. Reserve Now!</h2>
          </div>
          <div class="col-12 col-md-6 text-center text-md-right" data-aos="fade-up" data-aos-delay="200">
            <a href="reservation.html" class="btn btn-outline-white-primary py-3 text-white px-5">Reserve Now</a>
          </div>
        </div>
      </div>
    </section>`
 }; 
export default homePage;