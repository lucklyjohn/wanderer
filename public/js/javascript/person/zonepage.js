vi = new Vue({
    el:'#main',
    data:{
        'nav_title':''
    },
    created: function () {
        this.$http.get(
            '/api/people/render'
        ).then(function(data){
            var navbar = JSON.parse(data.body.nav.config);
            this.nav_title = navbar.title;
        },function(error){
            //error
            console.log(error);
        });
    }

});
