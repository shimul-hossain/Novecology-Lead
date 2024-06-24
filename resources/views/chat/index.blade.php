@extends('layouts.master')

@section('chatIndex')
    active 
@endsection

@section('content')
<script>
    var chat_appid = '60616';
    var chat_auth = 'f4adc8a4256c5a4b05ce3d67ac69b9ab';
      var chat_id = '{{ Auth::id() }}';
      var chat_name = '{{ Auth::user()->name }}';
      @if(Auth::user()->profile_photo)
      var chat_avatar = '{{ asset("uploads/crm/profiles") }}/{{ Auth::user()->profile_photo }}';
      @else 
      var chat_avatar = '{{ asset("crm_assets/assets/images/icons/user.png") }}';
      @endif
      var chat_link = '{{ url("admin/profile") }}';
  </script>
  {{-- <script>
    (function() {
      var chat_css = document.createElement('link'); chat_css.rel = 'stylesheet'; chat_css.type = 'text/css'; chat_css.href = 'https://fast.cometondemand.net/'+chat_appid+'x_xchat.css';
      document.getElementsByTagName("head")[0].appendChild(chat_css);
      var chat_js = document.createElement('script'); chat_js.type = 'text/javascript'; chat_js.src = 'https://fast.cometondemand.net/'+chat_appid+'x_xchat.js'; var chat_script = document.getElementsByTagName('script')[0]; chat_script.parentNode.insertBefore(chat_js, chat_script);
    })();
  </script> --}}
  <script>
    var chat_height = '800px';
    var chat_width = '100%';

    document.write('<div id="cometchat_embed_synergy_container" style="width:'+chat_width+';height:'+chat_height+';max-width:100%;border:1px solid #CCCCCC;border-radius:5px;overflow:hidden;"></div>');

    var chat_js = document.createElement('script'); chat_js.type = 'text/javascript'; chat_js.src = 'https://fast.cometondemand.net/'+chat_appid+'x_xchatx_xcorex_xembedcode.js';
    chat_js.onload = function() {
      var chat_iframe = {};chat_iframe.module="synergy";chat_iframe.style="min-height:"+chat_height+";min-width:"+chat_width+";";chat_iframe.width=chat_width.replace('px','');chat_iframe.height=chat_height.replace('px','');chat_iframe.src='https://'+chat_appid+'.cometondemand.net/cometchat_embedded.php'; if(typeof(addEmbedIframe)=="function"){addEmbedIframe(chat_iframe);}
    }
    var chat_script = document.getElementsByTagName('script')[0]; chat_script.parentNode.insertBefore(chat_js, chat_script);
  </script>

@endsection