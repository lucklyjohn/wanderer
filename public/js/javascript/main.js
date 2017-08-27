vi = new Vue({
    el:'#main',
    data:{
        'nav_title':'',
        'descriptor':''
    },
    created: function () {
        this.$http.get(
            '/api/main'
        ).then(function(data){
            var navbar = JSON.parse(data.body.nav.config);
            this.nav_title = navbar.title;
            this.descriptor = JSON.parse(data.body.descriptor.config);
            console.log(this.descriptor);
        },function(error){
            //error
            console.log(error);
        });
    }
});