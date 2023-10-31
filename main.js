//preloading
$(".loading-gif").hide();
$(document).on("load", function () {
  $(".loading-gif").show();
});

//opening and closing dropdown menu
$(document).ready(function () {
  $(window).on("click", function (event) {
    if (
      $(event.target).is(".dropdown-toggle word") ||
      $(event.target).is(".dropdown-toggle")
    ) {
      $(".dropdown-items").toggle();
    } else {
      $(".dropdown-items").hide();
    }
  });


  //opening search for mobile
  $('#mobile-search-opener').on('click', function(){
    $('nav #search').css('top', '0');
    $('nav #search input').focus();
    $('nav #search #close-search').on('click', function(e){
      e.preventDefault();
      $('nav #search').css('top', '-22vw');
    })
  })
});

//opening and closing messages dropdown
$(document).ready(function () {
  $(window).on("click", function (event) {
    if (
      $(event.target).is(".comments button .fa-comment") ||
      $(event.target).is(".comments button mark") || $(event.target).is(".comments button")
    ) {
      $(".each-comment").toggle();
    } else {
      $(".each-comment").hide();
    }
  });
});

//hide some navigation bar when scrolling dowwards
$(document).ready(function (){
  var prevScrollpos = window.pageYOffset;
  window.onscroll = function() {
  var currentScrollPos = window.pageYOffset;
    if($(window).width() > 900){
      if (prevScrollpos > currentScrollPos) {
        $('.navbar').css('top', '0').css('transition', '.4s');
      } else {
        $('.navbar').css('top', '-36px');
      }
      prevScrollpos = currentScrollPos;
    }
  }
})

//Slider buttons
$(document).ready(function(){
  // start slider function
  startSlider();

  // set width and step variables and add active class to first slider
  var slideWidth = $('.slides').width();
  $('#slide1').addClass('actives');
  function resetInterval(){
          window.clearInterval(looper);
          looper = setInterval(autoSlide, 5000);
  }
  function autoSlide(){
          // remove and add class active
          $('.actives').removeClass('actives').next().addClass('actives');

          // animation expression
          $('.actives').animate({
              'left': '-=' + (slideWidth) + 'px'
          }, 500);
          $('.actives').siblings().animate({
              'left': '-=' + (slideWidth) + 'px'
          }, 500);

          // return to first slide after the last one
          if ($('.actives').length === 0) {
              $('#slide1').addClass('actives');
              $('.slides').animate({
                  'left': 0
              }, 500);

          }
  }
  // actual function
  function startSlider() {

      looper = setInterval(autoSlide, 5000); // interva/


      // adding controls
      $('.slides').append("<div class='slider_navigator'><button class='btn slider-prev'><i class='fa-solid fa-angle-left'></i></button><button class='btn slider-next'><i class='fa-solid fa-angle-right'></i></button></div>");

      // remove unnecessary controlls on first and last slides
      $('.slides:nth-child(1) .slider-prev').css('visibility', 'hidden');
      $(".slides:nth-child(" + $('.slides').length + ") .slider-next").css('visibility', 'hidden');

      // add functionality to controls
      $('.slider-prev').on('click', function () {
          resetInterval();
          $('.actives').removeClass('active').prev().addClass('actives');
          $('.actives').animate({
              'left': '+=' + (slideWidth) + 'px'
          }, 500);
          $('.actives').siblings().animate({
              'left': '+=' + (slideWidth) + 'px'
          }, 500);
      });

      $('.slider-next').on('click', function () {
          resetInterval();
          $('.actives').removeClass('actives').next().addClass('actives');
          $('.actives').animate({
              'left': '-=' + (slideWidth) + 'px'
          }, 500);
          $('.actives').siblings().animate({
              'left': '-=' + (slideWidth) + 'px'
          }, 500);
      });
  }
});

//background
$("body").css("background", "#f2f2f2");

//horizontal scroll
//Recommedation part
$("#left").hide();
$("#right").on("click", function (e) {
  e.preventDefault();
  $(".card-container").animate({
    scrollLeft: "+=920px",
  });
});
$("#left").on("click", function (e) {
  e.preventDefault();
  $(".card-container").animate({
    scrollLeft: "-=920px",
  });
});

$(".card-container").scroll(function () {
  var $elem = $(".card-container");
  var newScrollLeft = $elem.scrollLeft(),
    width = $elem.outerWidth(),
    scrollWidth = $elem.get(0).scrollWidth;
  if (scrollWidth - width - newScrollLeft < 1) {
    $("#right").hide();
  } else {
    $("#right").show();
  }
  if (newScrollLeft === 0) {
    $("#left").hide();
  } else {
    $("#left").show();
  }
});

//lately added products scroll
$("#left2").hide();
$("#right2").on("click", function (e) {
  e.preventDefault();
  $(".card-container2").animate({
    scrollLeft: "+=920px",
  });
});
$("#left2").on("click", function (e) {
  e.preventDefault();
  $(".card-container2").animate({
    scrollLeft: "-=920px",
  });
});

$(".card-container2").scroll(function () {
  var $elem = $(".card-container2");
  var newScrollLeft = $elem.scrollLeft(),
    width = $elem.outerWidth(),
    scrollWidth = $elem.get(0).scrollWidth;
  if (scrollWidth - width - newScrollLeft < 1) {
    $("#right2").hide();
  } else {
    $("#right2").show();
  }
  if (newScrollLeft === 0) {
    $("#left2").hide();
  } else {
    $("#left2").show();
  }
});

//featured products
$("#left3").hide();
$("#right3").on("click", function (e) {
  e.preventDefault();
  $(".card-container3").animate({
    scrollLeft: "+=920px",
  });
});
$("#left3").on("click", function (e) {
  e.preventDefault();
  $(".card-container3").animate({
    scrollLeft: "-=920px",
  });
});

$(".card-container3").scroll(function () {
  var $elem = $(".card-container3");
  var newScrollLeft = $elem.scrollLeft(),
    width = $elem.outerWidth(),
    scrollWidth = $elem.get(0).scrollWidth;
  if (scrollWidth - width - newScrollLeft < 1) {
    $("#right3").hide();
  } else {
    $("#right3").show();
  }
  if (newScrollLeft === 0) {
    $("#left3").hide();
  } else {
    $("#left3").show();
  }
});

//requested products
$("#left4").hide();
$("#right4").on("click", function (e) {
  e.preventDefault();
  $(".card-container4").animate({
    scrollLeft: "+=920px",
  });
});
$("#left4").on("click", function (e) {
  e.preventDefault();
  $(".card-container4").animate({
    scrollLeft: "-=920px",
  });
});

$(".card-container4").scroll(function () {
  var $elem = $(".card-container4");
  var newScrollLeft = $elem.scrollLeft(),
    width = $elem.outerWidth(),
    scrollWidth = $elem.get(0).scrollWidth;
  if (scrollWidth - width - newScrollLeft < 1) {
    $("#right4").hide();
  } else {
    $("#right4").show();
  }
  if (newScrollLeft === 0) {
    $("#left4").hide();
  } else {
    $("#left4").show();
  }
});

//indicating the page you are in
$("nav [href]").each(function () {
  if (this.href == window.location.href) {
    $(this).addClass("active");
  }
});
//for small screens
$("header section [href]").each(function () {
  if (this.href == window.location.href) {
    $(this).addClass("active");
  }
});

//selecting sub-counties
$("#county").on("change", function () {
  var a = document.getElementById("county").value;

  if (a === "Bomet") {
    var array = [
      "--sub county--",
      "Sotik",
      "Chepalungu",
      "Bomet Central",
      "Bomet East",
      "Konoin",
    ];
  }
  if (a === "Baringo") {
    var array = [
      "--sub county--",
      "Tiaty",
      "Baringo North",
      "Barindo Central",
      "Baringo South",
      "Mogotio",
      "Eldama Ravine",
    ];
  }
  if (a === "Bungoma") {
    var array = [
      "--sub county--",
      "Mt-Elgon",
      "Sirisia",
      "Kabuchai",
      "Bumula",
      "Kanduyi",
      "Webuye East",
      "Webuye West",
      "Kimilili",
      "Tongaren",
    ];
  }
  if (a === "Busia") {
    var array = [
      "--sub county--",
      "Teso North",
      "Teso South",
      "Nambale",
      "Matayos",
      "Butula",
      "Funyula",
      "Budalangi",
    ];
  }
  if (a === "Elgeyo Marakwet") {
    var array = [
      "--sub county--",
      "Marakwet North",
      "Marakwet South",
      "Marakwet East",
      "Marakwet West",
    ];
  }
  if (a === "Embu") {
    var array = [
      "--sub county--",
      "Igembe South",
      "Igembe Central",
      "Igembe North",
      "Tigania West",
      "Tigania East",
      "North Imenti",
      "Buuri",
      "Central Imenti",
      "South Imenti",
    ];
  }
  if (a === "Garissa") {
    var array = [
      "--sub county--",
      "Garissa Township",
      "Balambala",
      "Dadaab",
      "Fafi",
      "Ijara",
    ];
  }
  if (a === "Homa Bay") {
    var array = [
      "--sub county--",
      "Kasipul",
      "Kabondo Kasipul",
      "Karachuonyo",
      "Rangwe",
      "Homa bay Town",
      "Ndhiwa",
      "Suba North",
      "Suba South",
    ];
  }
  if (a === "Isiolo") {
    var array = ["--sub county--", "Isiolo North", "Isiolo South"];
  }
  if (a === "Kwale") {
    var array = [
      "--sub county--",
      "Matuga",
      "Lungalunga",
      "Kinango",
      "Msambweni",
    ];
  }
  if (a === "Kilifi") {
    var array = [
      "--sub county--",
      "Kilifi North",
      "Kilifi South",
      "Kaloleni",
      "Rabai",
      "Ganze",
      "Malindi",
      "Magarini",
    ];
  }
  if (a === "Kirinyaga") {
    var array = [
      "--sub county--",
      "Mwea",
      "Gichugu",
      "Ndia",
      "Kirinyaga Central",
    ];
  }
  if (a === "Kiambu") {
    var array = [
      "--sub county--",
      "Gatundu North",
      "Gatundu South",
      "Juja",
      "Thika Town",
      "Ruiru",
      "Githunguri",
      "Kiambu",
      "Kiambaa",
      "Kabete",
      "Kikuyu",
      "Limuru",
      "Lari",
    ];
  }
  if (a === "Kajiado") {
    var array = [
      "--sub county--",
      "Kajiado North",
      "Kajiado South",
      "Kajiado Central",
      "Kajiado East",
      "Kajiado West",
    ];
  }
  if (a === "Kericho") {
    var array = [
      "--sub county--",
      "Kipkelion East",
      "Kipkelion West",
      "Ainamoi",
      "Bureti",
      "Belgut",
      "Sigowet/Soin",
    ];
  }
  if (a === "Kakamega") {
    var array = [
      "--sub county--",
      "Lugari",
      "Likuyani",
      "Malava",
      "Lurambi",
      "Navakholo",
      "Mumias West",
      "Mumias East",
      "Matundu",
      "Butere",
      "Khwisero",
      "Shinyalu",
      "Ikolomani",
    ];
  }
  if (a === "Kisumu") {
    var array = [
      "--sub county--",
      "Kisumu East",
      "Kisumu West",
      "Kisumu Central",
      "Seme",
      "Nyando",
      "Muhoroni",
      "Nyakach",
    ];
  }
  if (a === "Kisii") {
    var array = [
      "--sub county--",
      "Bonchari",
      "South Mugirango",
      "Bomachoge Borabu",
      "Bobasi",
      "Bomachoge chache",
      "Nyaribari Masaba",
      "Nyaribari Chache",
      "Kitutu Chache North",
      "Kitutu Chache South",
    ];
  }
  if (a === "Laikipia") {
    var array = [
      "--sub county--",
      "Laikipia North",
      "Laikipia Central",
      "Laikipia East",
      "Laikipia West",
      "Nyahururu",
    ];
  }
  if (a === "Kitui") {
    var array = [
      "--sub county--",
      "Kitui East",
      "Kitui West",
      "Kitui Central",
      "Kitui Rural",
      "Kitui South",
      "Mwingi North",
      "Mwingi West",
      "Mwingi Central",
    ];
  }
  if (a === "Lamu") {
    var array = ["--sub county--", "Lamu East", "Lamu West"];
  }
  if (a === "Machakos") {
    var array = [
      "--sub county--",
      "Masinga",
      "Yatta",
      "Matungulu",
      "Kangundo",
      "Mwala",
      "Kathiani",
      "Machakos Town",
      "Mavoko",
    ];
  }
  if (a === "Makueni") {
    var array = [
      "--sub county--",
      "Makueni",
      "Kalungu",
      "Mukaa",
      "Kibwezi East",
      "Kibwezi West",
      "Kilome",
    ];
  }
  if (a === "Mandera") {
    var array = [
      "--sub county--",
      "Mandera West",
      "Mandera South",
      "Banissa",
      "Mandera North",
      "Mandera East",
      "Lafey",
    ];
  }
  if (a === "Meru") {
    var array = [
      "--sub county--",
      "Igembe East",
      "Igembe South",
      "Igembe North",
      "Igembe West",
      "Buuri",
      "Imenti South",
      "Imenti North",
      "Imenti Central",
    ];
  }
  if (a === "Migori") {
    var array = [
      "--sub county--",
      "Rongo",
      "Awendo",
      "Suna East",
      "Suna West",
      "Uriri",
      "Nyatike",
      "Kuria West",
      "Kuria East",
      "Ntimaru",
      "Mabera",
    ];
  }
  if (a === "Marsabit") {
    var array = ["--sub county--", "Laisamis", "North Norr", "Moyale", "Saku"];
  }
  if (a === "Mombasa") {
    var array = [
      "--sub county--",
      "Changamwe",
      "Jomvu",
      "Kisauni",
      "Nyali",
      "Likoni",
      "Mvita",
    ];
  }
  if (a === "Muranga") {
    var array = [
      "--sub county--",
      "Kiharu",
      "Mathioya",
      "Kangema",
      "Gatanga",
      "Kigumo",
      "Kahuro",
      "Murang'a South",
    ];
  }
  if (a === "Nairobi") {
    var array = [
      "--sub county--",
      "Dagoretti South",
      "Dagoretti Central",
      "Embakasi East",
      "Embakasi South",
      "Embakasi North",
      "Embakasi West",
      "Kamukunji",
      "Kasarani",
      "KIbra",
      "Langata",
      "Makadara",
      "Mathare",
      "Roysambu",
      "Ruaraka",
      "Starehe",
      "Westlands",
    ];
  }
  if (a === "Nakuru") {
    var array = [
      "--sub county--",
      "Nakuru Town East",
      "Nakuru Town West",
      "Njoro",
      "Molo",
      "Gilgil",
      "Naivasha",
      "Kuresoi North",
      "Kuresoi South",
      "Rongai",
      "Subukia",
      "Bahati",
    ];
  }
  if (a === "Nandi") {
    var array = [
      "--sub county--",
      "Mosop",
      "Emgwen",
      "Aldai",
      "Tinderet",
      "Nandi Hills",
      "Chesumei",
    ];
  }
  if (a === "Narok") {
    var array = [
      "--sub county--",
      "Transmara West",
      "Transmara East",
      "Narok North",
      "Narok South",
      "Narok West",
      "Narok East",
    ];
  }
  if (a === "Nyamira") {
    var array = [
      "--sub county--",
      "Nyamira South",
      "Nyamira North",
      "Borabu",
      "Manga",
      "Masaba North",
    ];
  }
  if (a === "Nyandarua") {
    var array = [
      "--sub county--",
      "Kinangop",
      "Kipipiri",
      "ol Joro Orok",
      "Ndaragwa",
      "Ol Kalou",
    ];
  }
  if (a === "Nyeri") {
    var array = [
      "--sub county--",
      "Nyeri Town",
      "Mathira East",
      "Mathira West",
      "Tetu",
      "Mukurweni",
      "Kieni East",
      "Kieni West",
      "Othaya",
    ];
  }
  if (a === "Samburu") {
    var array = [
      "--sub county--",
      "Samburu East",
      "Samburu West",
      "Samburu North",
    ];
  }
  if (a === "Siaya") {
    var array = [
      "--sub county--",
      "Alego Usonga",
      "Ugenya",
      "Gem",
      "Bondo​​",
      "Ugunja",
      "Rarieda​​",
    ];
  }
  if (a === "Taita Taveta") {
    var array = ["--sub county--", "Voi", "Mwatate", "Wundanyi", "Taveta"];
  }
  if (a === "Tana River") {
    var array = ["--sub county--", "Bura", "Galole", "Garsen"];
  }
  if (a === "Tharaka Nithi") {
    var array = [
      "--sub county--",
      "Tharatha North",
      "Tharaka South",
      "Chuka",
      "Igambang’ombe",
      "Muthambi",
      "Maara",
    ];
  }
  if (a === "Trans Nzoia") {
    var array = [
      "--sub county--",
      "Cherengany",
      "Endebess",
      "Kwanza",
      "Kiminini",
      "Saboti",
    ];
  }
  if (a === "Turkana") {
    var array = [
      "--sub county--",
      "Loima",
      "Turkana West",
      "Turkana East",
      "Turkana North",
      "Turkana South",
      "Turkana Central",
    ];
  }
  if (a === "Uasin Gishu") {
    var array = [
      "--sub county--",
      "Soy",
      "Tarbo",
      "Ainabkoi",
      "Kapseret",
      "Kesses",
      "Moiben",
    ];
  }
  if (a === "Vihiga") {
    var array = [
      "--sub county--",
      "Emuhaya",
      "Sabatia",
      "Luanda",
      "Hamisi",
      "Vihiga",
    ];
  }
  if (a === "Wajir") {
    var array = [
      "--sub county--",
      "Wajir North",
      "Wajir South",
      "Wajir East",
      "Wajir West",
      "Eldas",
      "Tarbaj",
    ];
  }
  if (a === "West Pokot") {
    var array = [
      "--sub county--",
      "West Pokot",
      "North Pokot",
      "Pokot South",
      "Pokot Central",
    ];
  }

  var string = "";
  for (let i = 0; i < array.length; i++) {
    string = string + "<option>" + array[i] + "</option>";
  }
  document.getElementById("sub-county").innerHTML = string;
});

//cookie pop up
$(window).ready(function () {
  if (document.cookie.indexOf("guest_id") < 0) {
    console.log("no");
    setTimeout(function () {
      $(".cookie").fadeIn(800);
    }, 15000);
    sessionStorage.setItem(".cookie", "true");

    $(".cookie button").on("click", function () {
      $(".cookie").fadeOut(1000);
    });
  } else {
    console.log("yes");
    $(".cookie").hide();
  }
});

//Menu opening button for small screens
$(window).ready(function () {
  $("nav #open-menu").on("click", function () {
    $("header section").css("margin-left", "0");
  });
  $("header section #close, #content").on("click", function () {
    $("header section").css("margin-left", "-72%");
  });
});
