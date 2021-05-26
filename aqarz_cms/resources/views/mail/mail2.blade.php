


<!DOCTYPE html><html lang='ar'><head><meta charset='UTF-8'><title>رسالة جديدة</title></head><body>
<table style='width: 100%;'>
<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>
            <a href={{$details['link']}}><img src={{$details['logo']}} alt=''></a><br><br>
           </td></tr></thead><tbody><tr>
       <td style='border:none;'><strong>الاسم:</strong> {{$details['name']}}</td>
    <td style='border:none;'><strong>البريد الالكتروني:</strong>{{$details['from']}}</td>
     </tr>
   <tr><td style='border:none;'><strong>العنوان:</strong> {{$details['subject']}}</td></tr>
   <tr><td></td></tr>
    <tr><td colspan='2' style='border:none;'>{{$details['text_msg']}}</td></tr>
 <tr><td colspan='2' style='border:none;'>{{$details['message']}}</td></tr>
  </tbody></table>
</body></html>