<script type="text/javascript">
    (function() {
        @if(!empty(session('notify_error')))
            @php
                $data = session('notify_error');
                if(is_array($data)){
                    $res = $data;
                    foreach($res as $re){
                        $data.=$re.'</br>';
                    }
                }
            @endphp
            generateNotification('0','<?php print $data; ?>');
        @endif
        @if(!empty(session('notify_success')))
            @php
                $data = session('notify_success');
                if(is_array($data)){
                    $res = $data;
                    foreach($res as $re){
                        $data.=$re.'</br>';
                    }
                }
            @endphp
            generateNotification('1','<?php print $data; ?>');
        @endif
        @if(!empty(session('notify_info')))
            @php
                $data = session('notify_info');
                if(is_array($data)){
                    $res = $data;
                    foreach($res as $re){
                        $data.=$re.'</br>';
                    }
                }
            @endphp
            generateNotification('2','<?php print $data; ?>');
        @endif
        @if(!empty(session('notify_message')))
            @php
                $data = session('notify_message');
                if(is_array($data)){
                    $res = $data;
                    foreach($res as $re){
                        $data.=$re.'</br>';
                    }
                }
            @endphp
            generateNotification('1','<?php print $data; ?>');
        @endif
    })();
</script>