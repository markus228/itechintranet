/**
 * Created by markus on 02.03.16.
 */
$(function() {



    $("#news-box").bootstrapNews({
        newsPerPage: 3,
        autoplay: true,
        pauseOnHover: true,
        navigation: true,
        direction: 'down',
        newsTickerInterval: 10000,
        onToDo: function () {
            //console.log(this);
        }
    });







});