vue.created = function () {
    // alert('vue.created');
    this.loadmenu();
    jQuery('.sidebar-menu').show();
};
vue.data.pathparts = window.parseURL().pathparts
// console.log(vue.data.pathparts)
vue.data.menu = [
    {
        name: 'admin',
        title: '主菜单',
        child: [
            {
                name: 'ucenter',
                title: '用户中心',
                fa: 'user',
                child: [
                    {
                        name: 'profile',
                        title: '个人资料'
                    },
                    {
                        name: 'bindqq',
                        title: '绑定QQ'
                    }
                ]
            },
            {
                name: 'yun',
                title: '云服务',
                fa: 'cloud',
                child: [
                    {
                        name: 'ntuser',
                        title: '远程桌面账号'
                    },
                    {
                        name: 'web',
                        title: '免费空间'
                    }
                ]
            }
        ]
    }
];
vue.watch = {};
vue.watch.menu = function () {
    this.$nextTick(function(){
        console.log('watch.menu>$nextTick');
        jQuery(window).trigger('load');
    })
};
vue.methods.loadmenu = function () {
    const that = this;
    this.ApiPost_APP('?func=uc_session_check', {}).then(function (data) {
        // that.menu = [];
        if (data.hasOwnProperty('errno')) {
            if (data.errno !== 0) {
                location.href = URL_NAV + '/login.html'
            }
            return;
        }
    }, function (data) {
        location.href = '/login.html'
    }).catch(function (reason) {
        console.log('catch11:', reason);
    })
};
