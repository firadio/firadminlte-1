window.loadJs = function (url, callback) {
    const script = document.createElement('script');
    script.type = "text/javascript";
    if (typeof(callback) != "undefined") {
        if (script.readyState) {
            script.onreadystatechange = function () {
                if(script.readyState == "loaded" || script.readyState == "compl" + "ete"){
                    script.onreadystatechange = null;
                    callback();
                }
            }
        } else {
            script.onload = function () {
                callback();
            }
        }
    }
    script.src = url;
    document.body.appendChild(script);
};
window.str_replace = function(subtext, newtext, fulltext) {
    // 模仿PHP写的文本替换功能
    var i1 = 0;
    var i2 = 0;
    const arr = [];
    while (true) {
        i1 = fulltext.indexOf(subtext, i2);
        if (i1 === -1) {
            arr.push(fulltext.substr(i2));
            break;
        }
        arr.push(fulltext.substring(i2, i1));
        i2 = i1 + subtext.length;
    }
    return arr.join(newtext);
}
window.parseURL = function (url) {
    if (url === undefined) {
        url = window.location.href
    }
    const a = document.createElement('a');
    a.href = url;
    return {
        source: url,
        protocol: a.protocol.replace(':', ''),
        host: a.hostname,
        port: a.port,
        query: a.search,
        params: (function(){
            const ret = {}
            const seg = a.search.replace(/^\?/,'').split('&')
            const len = seg.length
            for (var i = 0; i<len; i++) {
                if (!seg[i]) { continue; }
                const s = seg[i].split('=');
                ret[s[0]] = s[1];
            }
            return ret;
        })(),
        file: (a.pathname.match(/\/([^\/?#]+)$/i) || [,''])[1],
        hash: a.hash.replace('#', ''),
        path: a.pathname.replace(/^([^\/])/, '/$1'),
        relative: (a.href.match(/tps?:\/\/[^\/]+(.+)/) || [,''])[1],
        segments: a.pathname.replace(/^\//, '').split('/'),
        pathparts: (function () {
            const sign = '-'
            var path = sign + a.pathname + sign
            path = window.str_replace('/', sign, path)
            path = window.str_replace(sign + sign, sign, path)
            const ret = path.split(sign);
            for (var i = 0; i<ret.length; i++) {
                ret[i] = ret[i].split('.')[0]
            }
            return ret;
        })()
    };
}
window.objCount = function (obj) {
  if (obj === undefined) {
    return 0
  }
  if (typeof (obj) !== 'object') {
    return 0
  }
  var i = 0
  for (var k in obj) {
    if (k) i++
  }
  return i
}
window.clone = function (obj) {
  if (typeof obj !== 'object') {
    return obj
  }
  if (obj === null) {
    return null
  }
  var o
  if (obj instanceof Array) {
    o = []
    for (var i = 0, len = obj.length; i < len; i++) {
      o.push(window.clone(obj[i]))
    }
  } else {
    o = {}
    for (var j in obj) {
      o[j] = window.clone(obj[j])
    }
  }
  return o
}
window.date = function (date) {
  function add0 (m) {
    return m < 10 ? '0' + m : m
  }
  if (date === undefined) {
    date = new Date()
  }
  const Y = date.getFullYear()
  const m = add0(date.getMonth() + 1)
  const d = add0(date.getDate())
  return Y + '-' + m + '-' + d
}
window.datetime = function (date) {
  function add0 (m) {
    return m < 10 ? '0' + m : m
  }
  if (date === undefined) {
    date = new Date()
  }
  const Ymd = window.date(date)
  const H = add0(date.getHours())
  const i = add0(date.getMinutes())
  const s = add0(date.getSeconds())
  return Ymd + ' ' + H + ':' + i + ':' + s
}
window.html_encode = function (str) {
  var s = ''
  if (str.length === 0) return ''
  s = str.replace(/&/g, '&gt;')
  s = s.replace(/</g, '&lt;')
  s = s.replace(/>/g, '&gt;')
  s = s.replace(/ /g, '&nbsp;')
  s = s.replace(/\\'/g, '&#39;')
  s = s.replace(/\\"/g, '&quot;')
  s = s.replace(/\r\n/g, '<br>')
  s = s.replace(/\r/g, '<br>')
  s = s.replace(/\n/g, '<br>')
  return s
}
window.getHtmlByBBCode = function (str) {
  const reg = new RegExp('\\[([A-Z]+)\\:([a-z]+)(\\,([a-z]+)\\=([\\dA-Za-z\\.]+))*\\]')
  const result = str.replace(reg, function () {
    const args = arguments
    const codePre = args[1]
    const codeType = args[2]
    if (codePre === 'CQ' && codeType === 'shake') {
      return window.getHtmlByCQCode_shake()
    }
    if (codePre === 'CQ' && codeType === 'face') {
      // return window.getHtmlByCQCode_face(args[5])
      return str
    }
    if (codePre === 'CQ' && codeType === 'image') {
      return window.getHtmlByCQCode_image(args[5])
    }
    return str
  })
  return result
}
window.getHtmlByCQCode_shake = function () {
  return '[shake震动]'
}
window.getHtmlByCQCode_face = function (id) {
  return '表情编号=' + id
}
window.getHtmlByCQCode_image = function (file) {
  const baseURL = window.api.config('baseURL')
  var url = baseURL + '/public/message/image.php'
  url += '?filename=' + file
  return '<a target=_blank href="' + url + '">图片</a>'
}
window.isMobile = function () {
  if (screen.width < screen.height) return true
  const sUserAgent = navigator.userAgent.toLowerCase()
  const bIsIpad = /ipad/i.test(sUserAgent)
  const bIsIphoneOs = /iphone os/i.test(sUserAgent)
  const bIsMidp = /midp/i.test(sUserAgent)
  const bIsUc7 = /rv:1.2.3.4/i.test(sUserAgent)
  const bIsUc = /ucweb/i.test(sUserAgent)
  const bIsAndroid = /android/i.test(sUserAgent)
  const bIsCE = /windows ce/i.test(sUserAgent)
  const bIsWM = /windows mobile/i.test(sUserAgent)
  if ((bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM)) {
    return true
  }
  return false
}
window.isIE = function () {
  const sUserAgent = navigator.userAgent
  if (sUserAgent.indexOf('MSIE') >= 0) {
    return true
  }
  if (sUserAgent.indexOf('Media Center') >= 0) {
    return true
  }
  if (sUserAgent.indexOf('.NET') >= 0) {
    return true
  }
  return false
}
const axios_config = {
  method: 'POST',
  headers: {
    'Content-Type': 'application/x-www-form-urlencoded'
  },
  data: {},
  timeout: 10000,
  transformRequest: function (data) {
    const ret = [];
    for (var it in data) {
      ret.push(encodeURIComponent(it) + '=' + encodeURIComponent(data[it]));
    }
    return ret.join('&');
  }
};
const vue = {};
vue.el = '#app';
// vue.created = function () {
    // alert('vue.created');
// };
vue.data = {};
vue.data.form = {};
vue.methods = {};
vue.methods.ApiPost_UC = function (path, param) {
  return vue.methods.ApiPost(APIURL_UC, path, param);
};
vue.methods.ApiPost_APP = function (path, param) {
  return vue.methods.ApiPost(APIURL_APP, path, param);
};
vue.methods.ApiPost = function (baseURL, path, param) {
  const conf = window.clone(axios_config);
  conf.baseURL = baseURL;
  conf.url = path;
  conf.data = param
  const appThis = {};
  appThis.warn = function () {};
  appThis.isLoading_api = true
  return new Promise(function (promise_resolve, promise_reject) {
    axios(conf).then(function (res) {
      appThis.isLoading_api = false
      if (!res.hasOwnProperty('status')) {
        appThis.warn('no status in res')
        return
      }
      if (res.status !== 200) {
        appThis.warn('res.status is ' + res.status)
        return
      }
      if (!res.hasOwnProperty('data')) {
        appThis.warn('no data in res')
        return
      }
      var data = res.data
      if (typeof (data) === 'string') {
        try {
          data = JSON.parse(data)
        } catch (ex) {
          data = {}
          appThis.warn(ex)
          return
        }
      }
      if (data.hasOwnProperty('message')) {
        // window.$vuf.alert(data.message, null, data.hasOwnProperty('title') ? data.title : null)
        alert(data.message);
      }
      const code = data.hasOwnProperty('code') ? parseInt(data.code, 10) : 0
      if (code !== 0) {
        promise_reject(data)
        return
      }
      promise_resolve(data)
    }).catch(function (error) {
      appThis.isLoading_api = false
      console.log(error)
      appThis.warn('无法连接到服务器<br />' + error)
    })
  })
};
