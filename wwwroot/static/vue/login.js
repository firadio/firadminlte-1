vue.data.form.email = (function(){
    if (!window.hasOwnProperty('localStorage')) {
        return '';
    }
    if (!window.localStorage.hasOwnProperty('email')) {
        return '';
    }
    return window.localStorage.email
})();
vue.data.form.password = '';
vue.data.form.remember = true;
vue.methods.submit = function () {
    const that = this;
    const form1 = {};
    form1.appid = 2;
    form1.email = (that.form.email);
    form1.pwdmd5 = md5(that.form.password);
    this.ApiPost_UC('?func=uc_session_login', form1).then(function (data) {
        if (that.form.remember) {
            window.localStorage.email = that.form.email;
        } else {
            window.localStorage.email = '';
        }
        if (data.hasOwnProperty('errno')) {
            if (data.errno === 0) {
                location.href = URL_NAV + '/admin.html'
            }
            return;
        }
    }, function (data) {
        console.log('reject:', data);
    }).catch(function (reason) {
        console.log('catch:', reason);
    })
};
