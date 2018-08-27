//localStorage.clear()
var lang=localStorage.getItem("lang"); 
if(lang==null){lang='zh';}
var www = '/'
/*var www = 'https://'+lang+'.ysv8.com/';/*API地址*/

var apiid = "888";/*ysv8联盟id*/
var optionss=localStorage.getItem("bucketcdn"+apiid); /*加载头像*/
if(optionss){var bucketcdn=optionss;}else{var bucketcdn='/';}
var optionss=localStorage.getItem("imgcdn"+apiid); /*加载头像*/
if(optionss){var imgcdn=optionss;}else{var imgcdn='/';}

var optionss=localStorage.getItem("user"+apiid); /*加载头像*/
if(optionss){userdata=JSON.parse(optionss);}else{userdata=false;}
var ysv8hex=localStorage.getItem("ysv8hex"+apiid); 
var qiandao=localStorage.getItem("qiandao"+apiid); 
var myDate = new Date(); 
var year = myDate.getFullYear(); 
var month = myDate.getMonth()+1;
var day = myDate.getDate(); 
var newDay = year + "/" + month + "/" + day;
function img_w_h(imgwh,imgsize){
imgwha =imgwh.split('@');
if(imgwha[0].substr(0,1)=='/')imgwha[0]=www+imgwha[0];
if(imgsize==''){
	imgwh=imgwha[0].replace('{m}',imgcdn);
	}else{
imgwh=imgwha[0].replace('{m}',bucketcdn);
	}
return imgwh+imgsize;
}
function timeStamp2String(time){ 
 var datetime = new Date() 
 datetime.setTime(time*1000); 
 var y = datetime.getFullYear(); 
 var m = datetime.getMonth() + 1; 
 var d = datetime.getDate(); 
 var h = datetime.getHours(); 
 var n =datetime.getMinutes(); 
 var s =datetime.getSeconds();
 if(y==year && month==m && day==d){
	  return h + ":" + n + ":" + s;
	 }
	 if(y==year){
	  return m+'-'+d+' '+h + ":" + n ;
	 }
 
 return y + "-" + m + "-" + d;
} 



var myuid=1;/*分红账号ID*/
var ajaxbool=false;
var pagtime=0;
var dataa=[];
var loadi=0;
var loadni=0; 
var wbi=0;wbni=0;wbtime=0;wbdata=[];wdata=[];
var langtext={zh:'简体中文',cht:'繁體中文',en:'English',ja:'日本の',ko:'한국의',es:'español',ru:'русский',ar:'العربية',fr:'français',hi:'हिन्दी',pt:'português',de:'Deutsch'}
var l={cht:{'充值':'充值','拍照':'拍照','相册':'相冊','自助广告':'自助廣告','金额':'金額','悬赏':'懸賞','综合':'綜合','首页':'首頁','图片':'圖片','视频':'視頻','附件':'附件','金币':'金幣','失败':'失敗','成功':'成功','更新':'更新','警告':'警告','登录':'登錄','加载':'加載','完毕':'完畢','发送':'發送','刚刚':'剛剛','阅后即焚':'閱後即焚','加密发送':'加密發送','密码':'密碼','输入':'輸入','空':'空','确认':'確認','取消':'取消','关闭':'關閉','清空':'清空','设置':'設置','系统':'系統','关注':'關注','已关注':'已關注','收藏':'收藏','评论':'評論','历史':'歷史','信息':'信息','退出':'退出','通用':'通用','关于':'關於','账户':'賬戶','重复密码':'重複密碼','电子邮箱':'電子郵箱','注册':'註冊','头像':'頭像','积分':'積分','等级':'等級','语言':'語言','自己':'自己','投稿':'投稿','标题':'標題','必填':'必填','小组':'小組','文件超大':'文件超大','小组为空':'小組為空','内容太少':'內容太少','网络中断':'網絡中斷','单位':'單位','抽奖':'抽獎','提现':'提現','周期':'周期','卖':'賣','买':'買','单价':'單價','数量':'數量','价格':'價格','操作':'操作','恭喜':'恭喜','明细':'明細','商城':'商城','创建':'創建','名称':'名稱','聊天':'聊天','赏':'賞','同道中人':'同道中人','复制':'複製','翻译':'翻譯',},en:{'充值':'Recharge','拍照':'Taking pictures','相册':'Photo album','自助广告':'Self-service advertising','金额':'Amount','悬赏':'Reward','综合':'Integrated','首页':'Home','图片':'image','视频':'video','附件':'annex','金币':'gold','失败':'failure','成功':'success','更新':'Updated','警告':'caveat','登录':'log in','加载':'load','完毕':'complete','发送':'send','刚刚':'just','阅后即焚':'After reading','加密发送':'Send encrypted','密码':'password','输入':'enter','空':'air','确认':'confirm','取消':'cancel','关闭':'shut down','清空':'Empty','设置':'Set up','系统':'system','关注':'attention','已关注':'Has been concerned','收藏':'Collection','评论':'comment','历史':'history','信息':'information','退出':'drop out','通用':'Universal','关于':'on','账户':'Account','重复密码':'Repeat password','电子邮箱':'E-mail','注册':'registered','头像':'Avatar','积分':'integral','等级':'grade','语言':'Language','自己':'Yourself','投稿':'Post','标题':'title','必填':'Required','小组':'group','文件超大':'Large file size','小组为空':'The team is empty','内容太少':'Too little content','网络中断':'Network interruption','单位':'unit','抽奖':'lottery','提现':'withdraw','周期':'cycle','卖':'Sell','买':'buy','单价':'unit price','数量':'Quantity','价格':'price','操作':'operating','恭喜':'Congratulations','明细':'Details','商城':'Mall','创建':'create','名称':'name','聊天':'to chat with','赏':'reward','同道中人':'Fellows','复制':'copy','翻译':'translation',},ja:{'充值':'再充電する','拍照':'写真を撮る','相册':'フォトアルバム','自助广告':'セルフサービス広告','金额':'金額','悬赏':'報酬','综合':'統合された','首页':'ホーム','图片':'ピクチャ','视频':'ビデオ','附件':'アクセサリー','金币':'金貨','失败':'失敗','成功':'成功','更新':'更新された','警告':'警告','登录':'サインイン','加载':'読み込み中','完毕':'完成した','发送':'送信','刚刚':'ちょうど今','阅后即焚':'読んだ後','加密发送':'暗号化を送信','密码':'パスワード','输入':'入力','空':'空','确认':'確認','取消':'キャンセル','关闭':'クローズド','清空':'空','设置':'セットアップ','系统':'システム','关注':'注意','已关注':'続かれた','收藏':'コレクション','评论':'コメント','历史':'歴史','信息':'情報','退出':'出口','通用':'ユニバーサル','关于':'〜について','账户':'アカウント','重复密码':'パスワードを繰り返します','电子邮箱':'Eメール','注册':'登録する','头像':'アバター','积分':'ポイント','等级':'レベル','语言':'言語','自己':'あなた自身','投稿':'投稿','标题':'タイトル','必填':'必須','小组':'グループ','文件超大':'ファイルサイズが大きい','小组为空':'チームは空です','内容太少':'コンテンツが少なすぎる','网络中断':'ネットワークの中断','单位':'ユニット','抽奖':'宝くじ','提现':'現金引き出し','周期':'サイクル','卖':'販売','买':'購入する','单价':'単価','数量':'数量','价格':'価格','操作':'オペレーション','恭喜':'おめでとう','明细':'詳細','商城':'モール','创建':'作成された','名称':'名前','聊天':'チャット','赏':'報酬','同道中人':'フェロー','复制':'重複','翻译':'翻訳',},ko:{'充值':'재충전','拍照':'사진 찍기','相册':'사진 앨범','自助广告':'셀프 서비스 광고','金额':'금액','悬赏':'보상','综合':'합성','首页':'홈','图片':'그림','视频':'비디오','附件':'액세서리','金币':'금화','失败':'실패','成功':'성공','更新':'업데이트 됨','警告':'경고','登录':'로그인','加载':'로드 중','完毕':'완성 된','发送':'보내는 중','刚刚':'바로 지금','阅后即焚':'독서 후','加密发送':'암호화 된 메일 보내기','密码':'비밀번호','输入':'입력','空':'빈','确认':'확인','取消':'취소','关闭':'휴무일','清空':'빈','设置':'설정','系统':'시스템','关注':'주의','已关注':'뒤따른','收藏':'컬렉션','评论':'댓글','历史':'역사','信息':'정보','退出':'출구','通用':'유니버설','关于':'정보','账户':'계정','重复密码':'비밀번호 반복','电子邮箱':'이메일','注册':'등록하려면','头像':'아바타','积分':'포인트','等级':'수준','语言':'언어','自己':'너 자신','投稿':'게시물','标题':'제목','必填':'필수','小组':'그룹','文件超大':'큰 파일 크기','小组为空':'팀이 비어 있습니다.','内容太少':'콘텐츠가 너무 적습니다.','网络中断':'네트워크 중단','单位':'단위','抽奖':'복권','提现':'현금 인출','周期':'주기','卖':'판매','买':'구매','单价':'단가','数量':'수량','价格':'가격','操作':'운영','恭喜':'축하해.','明细':'세부 정보','商城':'몰','创建':'생성됨','名称':'이름','聊天':'채팅','赏':'보상','同道中人':'펠로우','复制':'중복','翻译':'번역',},es:{'充值':'Recargar','拍照':'Tomando fotos','相册':'Álbum de fotos','自助广告':'Publicidad de autoservicio','金额':'Monto','悬赏':'Recompensa','综合':'Síntesis','首页':'Inicio','图片':'Imagen','视频':'Video','附件':'Accesorios','金币':'Monedas de oro','失败':'Fallido','成功':'Éxito','更新':'Actualizado','警告':'Advertencia','登录':'Iniciar sesión','加载':'Cargando','完毕':'Terminado','发送':'Enviando','刚刚':'Justo ahora','阅后即焚':'Después de leer','加密发送':'Enviar encriptado','密码':'Contraseña','输入':'Entrada','空':'Vacío','确认':'Confirmación','取消':'Cancelación','关闭':'Cerrado','清空':'Vacío','设置':'Configurar','系统':'Sistema','关注':'Atención','已关注':'Seguido','收藏':'Colección','评论':'Comentario','历史':'Historia','信息':'Información','退出':'Salir','通用':'Universal','关于':'Acerca de','账户':'Cuenta','重复密码':'Repita la contraseña','电子邮箱':'E-mail','注册':'Para registrarse','头像':'Avatar','积分':'Puntos','等级':'Nivel','语言':'Idioma','自己':'Usted mismo','投稿':'Publicar','标题':'Título','必填':'Requerido','小组':'Grupo','文件超大':'Tamaño de archivo grande','小组为空':'El equipo esta vacio','内容太少':'Muy poco contenido','网络中断':'Interrupción de red','单位':'Unidad','抽奖':'Dibujar','提现':'Retiro de efectivo','周期':'Ciclos','卖':'Vender','买':'Comprar','单价':'Precio unitario','数量':'Cantidad','价格':'Precios','操作':'Operaciones','恭喜':'Felicitaciones','明细':'Detalles','商城':'Centro comercial','创建':'Creado','名称':'El nombre','聊天':'Chateando','赏':'Recompensa','同道中人':'Compañeros','复制':'Duplicado','翻译':'Traducir',},ru:{'充值':'перезарядка','拍照':'Фотосъемка','相册':'Фотоальбом','自助广告':'Реклама для самообслуживания','金额':'деньги','悬赏':'Предложить вознаграждение','综合':'комплекс','首页':'дома','图片':'изображение','视频':'видео','附件':'аксессуар','金币':'Золотые монеты','失败':'недостаточность','成功':'успех','更新':'обновление','警告':'предупреждение','登录':'Войти','加载':'нагрузка','完毕':'полный','发送':'послать','刚刚':'Только сейчас','阅后即焚':'После прочтения','加密发送':'Отправить зашифрованный','密码':'пароль','输入':'запись','空':'пустой','确认':'подтвердить','取消':'отменен','关闭':'близко','清空':'ясно','设置':'Настроить','系统':'система','关注':'внимание','已关注':'Внимание было','收藏':'собирать','评论':'обзор','历史':'история','信息':'информация','退出':'выход','通用':'общий','关于':'на','账户':'счета','重复密码':'Повторить пароль','电子邮箱':'Электронная почта','注册':'Зарегистрировать','头像':'Руководитель портрет','积分':'интеграция','等级':'рейтинг','语言':'язык','自己':'собственный','投稿':'вклад','标题':'заголовок','必填':'обязательное','小组':'группа','文件超大':'Большой размер файла','小组为空':'Команда пуста','内容太少':'Слишком мало контента','网络中断':'Сетевое прерывание','单位':'блок','抽奖':'лотерея','提现':'Снятие наличных','周期':'цикл','卖':'продавать','买':'купить','单价':'Цена за единицу','数量':'количество','价格':'цена','操作':'операционная','恭喜':'поздравление','明细':'детали','商城':'Торговый центр','创建':'создать','名称':'Название','聊天':'чат','赏':'вознаграждение','同道中人':'Fellow человек','复制':'копия','翻译':'перевод',},ar:{'充值':'إعادة شحن البطارية','拍照':'التقاط الصور','相册':'ألبوم الصور','自助广告':'إعلانات الخدمة الذاتية','金额':'نقود','悬赏':'عرض مكافأة','综合':'مجمع','首页':'منزل','图片':'صور','视频':'فيديو','附件':'ملحق','金币':'العملات الذهبية','失败':'فشل','成功':'نجاح','更新':'تحديث','警告':'تحذير','登录':'تسجيل الدخول','加载':'حمل','完毕':'كامل','发送':'إرسال','刚刚':'فقط الآن','阅后即焚':'بعد القراءة','加密发送':'إرسال مشفر','密码':'كلمة المرور','输入':'دخول','空':'فارغ','确认':'أكد','取消':'ألغيت','关闭':'قريب','清空':'واضح','设置':'إعداد','系统':'نظام','关注':'اهتمام','已关注':'وكان الاهتمام','收藏':'جمع','评论':'مراجعة','历史':'تاريخ','信息':'معلومات','退出':'استقال','通用':'مشترك','关于':'في','账户':'حساب','重复密码':'كرر كلمة المرور','电子邮箱':'البريد الإلكتروني E-','注册':'للتسجيل','头像':'رئيس صورة','积分':'التكامل','等级':'تصنيف','语言':'لغة','自己':'خاص','投稿':'إسهام','标题':'عنوان رئيسي','必填':'إلزامي','小组':'مجموعة','文件超大':'حجم ملف كبير','小组为空':'الفريق فارغ','内容太少':'محتوى قليل جدًا','网络中断':'انقطاع الشبكة','单位':'وحدة','抽奖':'اليانصيب','提现':'السحب النقدي','周期':'دورة','卖':'بيع','买':'شراء','单价':'سعر الوحدة','数量':'كمية','价格':'السعر','操作':'التشغيل','恭喜':'تهنئة','明细':'تفاصيل','商城':'مول','创建':'خلق','名称':'الاسم','聊天':'ثرثرة','赏':'مكافأة','同道中人':'الإنسان زملائه','复制':'نسخة','翻译':'ترجمة',},fr:{'充值':'Recharge','拍照':'Prendre des photos','相册':'Album photo','自助广告':'Publicité libre-service','金额':'Montant','悬赏':'Récompense','综合':'Synthèse','首页':'Accueil','图片':'Photo','视频':'Vidéo','附件':'Accessoires','金币':'Monnaies en or','失败':'Échec','成功':'Succès','更新':'Mis à','警告':'Avertissement','登录':'Connectez-vous','加载':'Chargement','完毕':'Terminé','发送':'Envoi','刚刚':'Juste maintenant','阅后即焚':'Après avoir lu','加密发送':'Envoyer crypté','密码':'Mot de passe','输入':'Entrée','空':'Vide','确认':'Confirmation','取消':'Annulation','关闭':'Fermé','清空':'Vide','设置':'Mise en place','系统':'Système','关注':'Attention','已关注':'Suivi','收藏':'Collection','评论':'Commentaire','历史':'Histoire','信息':'Information','退出':'Sortie','通用':'Universel','关于':'À propos','账户':'Compte','重复密码':'Répétez le mot','电子邮箱':'E-mail','注册':'S\'inscrire','头像':'Avatar','积分':'Points','等级':'Niveau','语言':'Langue','自己':'Vous-meme','投稿':'Poster','标题':'Titre','必填':'Obligatoire','小组':'Groupe','文件超大':'Grande taille de fichier','小组为空':'L\'équipe est vide','内容太少':'Trop peu de contenu','网络中断':'Interruption du réseau','单位':'Unité','抽奖':'Dessiner','提现':'Retrait en espèces','周期':'Cycles','卖':'Vendre','买':'Acheter','单价':'Prix ​​unitaire','数量':'Quantité','价格':'Prix','操作':'Opérations','恭喜':'Félicitations','明细':'Détails','商城':'Mall','创建':'Créé','名称':'Le nom','聊天':'Bavarder','赏':'Récompense','同道中人':'Fellows','复制':'Dupliquer','翻译':'Traduire',},hi:{'充值':'फिर से दाम लगाना','拍照':'चित्र लेना','相册':'फोटो एलबम','自助广告':'स्वयं सेवा विज्ञापन','金额':'पैसा','悬赏':'एक इनाम की पेशकश','综合':'जटिल','首页':'घर','图片':'चित्र','视频':'वीडियो','附件':'सहायक','金币':'सोने के सिक्कों','失败':'असफलता','成功':'सफलता','更新':'अद्यतन','警告':'चेतावनी','登录':'साइन इन करें','加载':'भार','完毕':'पूरा','发送':'भेजना','刚刚':'बस अभी','阅后即焚':'पढ़ने के बाद','加密发送':'एन्क्रिप्टेड भेजें','密码':'पासवर्ड','输入':'प्रविष्टि','空':'खाली','确认':'की पुष्टि करें','取消':'रद्द','关闭':'पास','清空':'स्पष्ट','设置':'सेट अप करें','系统':'प्रणाली','关注':'ध्यान दें','已关注':'ध्यान से किया गया है','收藏':'एकत्र','评论':'समीक्षा','历史':'इतिहास','信息':'सूचना','退出':'छोड़ना','通用':'सामान्य','关于':'पर','账户':'खाता','重复密码':'दोहराएं पासवर्ड','电子邮箱':'ई-मेल','注册':'रजिस्टर करने के लिए','头像':'हेड चित्र','积分':'एकीकरण','等级':'रेटिंग','语言':'भाषा','自己':'अपना','投稿':'योगदान','标题':'शीर्षक','必填':'अनिवार्य','小组':'समूह','文件超大':'बड़ा फ़ाइल आकार','小组为空':'टीम रिक्त है','内容太少':'बहुत कम सामग्री','网络中断':'नेटवर्क रुकावट','单位':'इकाई','抽奖':'लॉटरी','提现':'नकद निकासी','周期':'चक्र','卖':'बेचना','买':'खरीदें','单价':'इकाई मूल्य','数量':'मात्रा','价格':'कीमत','操作':'ऑपरेटिंग','恭喜':'बधाई','明细':'विवरण','商城':'मॉल','创建':'बनाएं','名称':'नाम','聊天':'बातचीत','赏':'इनाम','同道中人':'इंसान','复制':'प्रतिलिपि','翻译':'अनुवाद',},pt:{'充值':'Recarregar','拍照':'Tirando fotos','相册':'Álbum de fotos','自助广告':'Publicidade self-service','金额':'Quantidade','悬赏':'Recompensa','综合':'Síntese','首页':'Home','图片':'Imagem','视频':'Vídeo','附件':'Acessórios','金币':'Moedas de ouro','失败':'Falhou','成功':'Sucesso','更新':'Atualizado','警告':'Aviso','登录':'Iniciar sessão','加载':'Carregando','完毕':'Terminado','发送':'Enviando','刚刚':'Agora mesmo','阅后即焚':'Depois de ler','加密发送':'Enviar criptografado','密码':'Senha','输入':'Entrada','空':'Vazio','确认':'Confirmação','取消':'Cancelar','关闭':'Fechado','清空':'Vazio','设置':'Configurar','系统':'Sistema','关注':'Atenção','已关注':'Seguido','收藏':'Coleção','评论':'Comente','历史':'História','信息':'Informação','退出':'Sair','通用':'Universal','关于':'Sobre','账户':'Conta','重复密码':'Repetir senha','电子邮箱':'E-mail','注册':'Para se registrar','头像':'Avatar','积分':'Pontos','等级':'Level','语言':'Idioma','自己':'Você mesmo','投稿':'Post','标题':'Título','必填':'Obrigatório','小组':'Grupo','文件超大':'Tamanho de arquivo grande','小组为空':'A equipe está vazia','内容太少':'Muito pouco conteúdo','网络中断':'Interrupção de rede','单位':'Unit','抽奖':'Desenhar','提现':'Retirada de dinheiro','周期':'Ciclos','卖':'Venda','买':'Comprar','单价':'Preço unitário','数量':'Quantidade','价格':'Preços','操作':'Operações','恭喜':'Parabéns','明细':'Detalhes','商城':'Mall','创建':'Criado','名称':'O nome','聊天':'Conversando','赏':'Recompensa','同道中人':'Companheiros','复制':'Duplicar','翻译':'Traduzir',},de:{'充值':'Aufladen','拍照':'Bilder machen','相册':'Fotoalbum','自助广告':'Self-Service-Werbung','金额':'Betrag','悬赏':'Belohnung','综合':'Integriert','首页':'Zuhause','图片':'Bild','视频':'Video','附件':'Zubehör','金币':'Goldmünzen','失败':'Fehlgeschlagen','成功':'Erfolg','更新':'Aktualisiert','警告':'Warnung','登录':'Anmelden','加载':'Laden','完毕':'Fertig','发送':'Senden','刚刚':'Gerade jetzt','阅后即焚':'Nach dem Lesen','加密发送':'Senden Sie verschlüsselt','密码':'Passwort','输入':'Eingabe','空':'Leer','确认':'Bestätigung','取消':'Abbrechen','关闭':'Geschlossen','清空':'Leer','设置':'Aufstellen','系统':'System','关注':'Achtung','已关注':'Gefolgt','收藏':'Sammlung','评论':'Kommentar','历史':'Geschichte','信息':'Informationen','退出':'Beenden','通用':'Universal','关于':'Über','账户':'Konto','重复密码':'Passwort wiederholen','电子邮箱':'E-Mail','注册':'Zu registrieren','头像':'Avatar','积分':'Punkte','等级':'Stufe','语言':'Sprache','自己':'Dich selbst','投稿':'Posten','标题':'Titel','必填':'Erforderlich','小组':'Gruppe','文件超大':'Große Dateigröße','小组为空':'Das Team ist leer','内容太少':'Zu wenig Inhalt','网络中断':'Netzwerkunterbrechung','单位':'Einheit','抽奖':'Zeichnen','提现':'Bargeldbezug','周期':'Zyklen','卖':'Verkaufen','买':'Kaufen','单价':'Stückpreis','数量':'Menge','价格':'Preise','操作':'Operationen','恭喜':'Herzlichen Glückwunsch','明细':'Details','商城':'Mall','创建':'Erstellt','名称':'Der Name','聊天':'Chatten','赏':'Belohnung','同道中人':'Fellows','复制':'Duplizieren','翻译':'Übersetzung',},zh:{'充值':'充值','拍照':'拍照','相册':'相册','自助广告':'自助广告','金额':'金额','悬赏':'悬赏','综合':'综合','首页':'首页','图片':'图片','视频':'视频','附件':'附件','金币':'金币','失败':'失败','成功':'成功','更新':'更新','警告':'警告','登录':'登录','加载':'加载','完毕':'完毕','发送':'发送','刚刚':'刚刚','阅后即焚':'阅后即焚','加密发送':'加密发送','密码':'密码','输入':'输入','空':'空','确认':'确认','取消':'取消','关闭':'关闭','清空':'清空','设置':'设置','系统':'系统','关注':'关注','已关注':'已关注','收藏':'收藏','评论':'评论','历史':'历史','信息':'信息','退出':'退出','通用':'通用','关于':'关于','账户':'账户','重复密码':'重复密码','电子邮箱':'电子邮箱','注册':'注册','头像':'头像','积分':'积分','等级':'等级','语言':'语言','自己':'自己','投稿':'投稿','标题':'标题','必填':'必填','小组':'小组','文件超大':'文件超大','小组为空':'小组为空','内容太少':'内容太少','网络中断':'网络中断','单位':'单位','抽奖':'抽奖','提现':'提现','周期':'周期','卖':'卖','买':'买','单价':'单价','数量':'数量','价格':'价格','操作':'操作','恭喜':'恭喜','明细':'明细','商城':'商城','创建':'创建','名称':'名称','聊天':'聊天','赏':'赏','同道中人':'同道中人','复制':'复制','翻译':'翻译',},}
/*字符*/
function autoGrow (oField) {
if (oField.scrollHeight > oField.clientHeight) oField.style.height = oField.scrollHeight + "px";
}
function wgroup(group){
var table=document.body.querySelector('.mui-slider-group');
var table2=document.getElementById('group');
 for (i = 0;i < group.length; i++) {
var li = document.createElement('div');
var li2 = document.createElement('a');
if(group[i]['size']==3){
li.className = 'mui-slider-item mui-control-content mui-active';
li2.className = 'mui-control-item mui-active';
}else{
li.className = 'mui-slider-item mui-control-content';
li2.className = 'mui-control-item';
}
li.id='item'+i+'mobile';
li2.href='#item'+i+'mobile';
li.innerHTML = '<div id="scroll1" class="mui-scroll-wrapper"><div class="mui-scroll" id="ms'+i+'" did="'+group[i]['id']+'"><ul class="mui-table-view" id="mv'+i+'"></ul></div></div>';
li2.innerHTML = group[i]['name'];
table.appendChild(li);
table2.appendChild(li2);
}
}
var groupmy=[];
var optionss=localStorage.getItem("groupmy"+apiid); 
if(optionss){groupmy=JSON.parse(optionss);} 
var myfr=[];
var optionss=localStorage.getItem("myfr"+apiid); 
if(optionss){myfr=JSON.parse(optionss);}
var vote_data=[];
/*数组中是否存在*/
function in_array(aid,array){
for (j = 0;j < array.length; j++){
if(array[j]==aid){return false;}}
return true;
} 
/*传递参数*/
function getQueryString(name) { 
 var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); 
 var r = window.location.search.substr(1).match(reg); 
 if (r != null) return decodeURI(r[2]); 
 return null; 
 }

/*搜索支持*/
function sreachsub(){
var q = document.getElementById('sreach').value;
 mui.openWindow({
 url: 's.html?q='+encodeURI(q), 
 id:'s'+encodeURI(q)
 });
 return false;
}
/*写html*/
function setads(table,data){
var li = document.createElement('div');
li.className = 'a46060'; 
li.innerHTML = '<img class="ads" data-si="'+data['size']+'" data-id="'+data['id']+'" src="'+data['img']+'_'+data['size']+'" />';
table.appendChild(li);
}
function set_ai_html(mydata,table,id,mysize){
if(document.getElementById('ai')) return false;
var li = document.createElement('li');
li.className = 'mui-table-view-cell';
li.id = 'ai';
mydata=mydata.replace('https://huaren-hk.oss-cn-hongkong.aliyuncs.com/public/mui/js/autosize.min.js','js/autosize.min.js');
li.innerHTML = mydata.replace('<textarea','<textarea onKeyUp="autoGrow(this);"');

	table.insertBefore(li, table.firstChild);
	
	setTimeout(executeScript(mydata),1000);
}
function set_gs_html(mydata,table,id,mysize){
loadi++;
thisimg='';
thisgold='';
if(!in_array(id+'_'+mydata.cacheId,dataa)) return false;
loadni++;
dataa.push(id+'_'+mydata.cacheId);
if(typeof(mydata['pagemap']['cse_image']) != 'undefined'){
	thisgold=mydata['pagemap']['cse_image'][0]['src'];
if(thisgold.substr(0,4)=='http'){thisimg='<img class="liimg" src="'+mydata['pagemap']['cse_image'][0]['src']+'" onerror="imgerror(this)">';}
}
var li = document.createElement('li');
li.className = 'mui-table-view-cell';
li.innerHTML = '<a class="mui-media-body" herf="'+mydata['link']+'" data-size="gs">'+mydata.htmlTitle+'</a><p class="mui-ellipsis p10">'+mydata.htmlSnippet+'</p>'+thisimg;
if(mysize=='up'){table.appendChild(li);}else{table.insertBefore(li, table.firstChild);}	
}

function sethtml(mydata,table,id,mysize){
loadi++;
thisimg='';
thisgold='';
if(!in_array(id+'_'+mydata.id,dataa)) return false;
loadni++;
dataa.push(id+'_'+mydata.id);
mydata['btime']=Number(mydata['btime']);
if(pagtime>mydata['btime'] || pagtime==0){pagtime=mydata['btime']}

if(mydata['vs']!=''){
thisimg='<video src="'+bucketcdn+mydata['vs'].replace('{m}','')+'" controls="controls" preload="none" poster="'+bucketcdn+mydata['vs'].replace('{m}','')+'?x-oss-process=video/snapshot,t_1000,f_jpg,m_fast"></video>';
}else{
if (mydata['img']!=''){
ss = mydata['img'].split(",");
if(ss[0].length>10){thisimg='<a herf="'+mydata.id+'"><img class="liimg" src="'+img_w_h(ss[0],'_180')+'" onerror="imgerror(this)"></a>'; } 
}
}
var li = document.createElement('li');
li.className = 'mui-table-view-cell';
li.innerHTML = '<a class="mui-media-body" herf="'+mydata.id+'">'+mydata.title+'</a>'+thisimg+'<p class="mui-ellipsis p10"><span class="mui-icon mui-icon-person"></span>'+mydata.user+'<a class="mui-pull-right black" herf="'+mydata.id+'"><span class="mui-icon mui-icon-chat"></span>'+mydata.posts+'</a>';
if(mysize=='up'){table.appendChild(li);}else{table.insertBefore(li, table.firstChild);}
}
function sethtml2(mydata,table,id,mysize){
thisimg='';
if(mydata['vs']!=''){
thisimg='<video src="'+bucketcdn+mydata['vs'].replace('{m}','')+'" controls="controls" preload="none" "'+bucketcdn+mydata['vs'].replace('{m}','')+'?x-oss-process=video/snapshot,t_1000,f_jpg,m_fast"></video>';
}else{
if (mydata['img']!=''){
ss = mydata['img'].split(",");
if(ss[0].length>10){thisimg='<a herf="'+mydata.id+'" data-mode="'+mydata.mode+'"><img class="liimg" src="'+img_w_h(ss[0],'_180')+'" onerror="imgerror(this)"></a>'; } 
}
}
var li = document.createElement('li');
li.className = 'mui-table-view-cell';
li.innerHTML = '<a class="mui-media-body" herf="'+mydata.id+'" data-mode="'+mydata.mode+'">'+mydata.title+'</a>'+thisimg+'<p class="mui-ellipsis p10"><span class="mui-icon mui-icon-person"></span>'+mydata.user+'<a class="mui-pull-right black" herf="'+mydata.id+'" data-mode="'+mydata.mode+'"><span class="mui-icon mui-icon-chat"></span>'+mydata.posts+'</a>';
if(mysize=='up'){table.appendChild(li);}else{table.insertBefore(li, table.firstChild);}

}


function sethtml_weibo(mydata,table,id,mysize){
wbi++;
if(!in_array(id+'_'+mydata.id,wbdata)) return false;
wbni++;
wbdata.push(id+'_'+mydata.id);
mydata['btime']=Number(mydata['btime']);
if(wbtime>mydata['btime'] || wbtime==0){wbtime=mydata['btime']}
thisimg='';
thisgold='';
if(mydata['v']!=''){
thisimg+='<video src="'+mydata['v'].replace('{m}',cdnurl+'upload/')+'" controls="controls" preload="none" "'+mydata['v'].replace('{m}',cdnurl +'upload/')+'?x-oss-process=video/snapshot,t_7000,f_jpg,m_fast"></video>';
}
if (mydata['img']!=''){
ss = mydata['img'].split(",");
for (imgi = 0;imgi < 1; imgi++) {
if(ss[imgi].length>10){thisimg+='<div class="pla weibot" data-id="'+mydata['id']+'"><img class="liimg" src="'+img_w_h(ss[0],'_180')+'" onerror="imgerror(this)"></div>'; } 
}
}
var li = document.createElement('li');
li.className = 'mui-table-view-cell mui-media';
li.innerHTML = '<div class="mui-media-body weibot" data-id="'+mydata['id']+'"><span class="mui-icon mui-icon-person"></span>'+mydata.user+'<div class="mui-pull-right plupdown"><span class="mui-icon-extra mui-icon-extra-like" data-id="'+mydata['id']+'" size="goods">'+mydata['goods']+'</span><span class="mui-icon mui-icon-trash" data-id="'+mydata['id']+'" size="nos">'+mydata['nos']+'</span></div><div>'+nl2br(mydata.summary)+'</div></div>'+thisimg+'<p class="mui-ellipsis p10">'+timeStamp2String(mydata.btime)+'<div class="mui-pull-right black  weibot" data-id="'+mydata.id+'"><span class="mui-icon mui-icon-chat"></span>'+mydata.posts+'</div>';
if(mysize=='up'){table.appendChild(li);}else{table.insertBefore(li, table.firstChild);}
}
function getScrollTop() { 
var scrollTop = 0; 
if (document.documentElement && document.documentElement.scrollTop) { scrollTop = document.documentElement.scrollTop; } 
else if (document.body) { scrollTop = document.body.scrollTop; } 
return scrollTop; 
} 
//获取当前可是范围的高度 
function getClientHeight() { 
var clientHeight = 0; 
if (document.body.clientHeight && document.documentElement.clientHeight) { clientHeight = Math.min(document.body.clientHeight, document.documentElement.clientHeight); 
} else { clientHeight = Math.max(document.body.clientHeight, document.documentElement.clientHeight); } 
return clientHeight; 
} 
//获取文档完整的高度 
function getScrollHeight() { 
return Math.max(document.body.scrollHeight, document.documentElement.scrollHeight); 
} 
function nl2br (str, is_xhtml) {
var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
}
function mswal(data){
if(typeof(data['link'])=="undefined"){ 
 mui.alert(data['info']);
}else{ 
if(data['link']=='/user/login'){
 mui.alert(data['info'],l[lang]['警告'],l[lang]['登录'],function(data){
 mui.openWindow({
 url: 'setting.html', 
 id:'setting'
 });});
}

if(data['link']=='/gold/cz.html'){
 mui.alert(data['info'],l[lang]['警告'],l[lang]['充值'],function(data){
 mui.openWindow({
 url: 'cz.html?q='+encodeURI(www +'mui/more.html'), 
 id:'cz.html'
 });});
}
}
 }
 
function in_myfr(id){
for (idi = 0;idi < myfr.length; idi++) {if(myfr[idi]['id']==id && (myfr[idi]['state']==1 || myfr[idi]['state']==2)){return true;}}
return false;
}
function add_myfr(id,name,size){
for (idi = 0;idi < myfr.length; idi++) {
if(myfr[idi]['id']==id){myfr.splice(idi,1);}
}
if(size=='add'){
var news_sub={
 id:id,
 name:name,
 state:2
 }
myfr.push(news_sub);  
}
localStorage.setItem("myfr"+apiid,JSON.stringify(myfr)); 
}
function in_group(id){
for (idi = 0;idi < groupmy.length; idi++) {
if(groupmy[idi]['id']==id && groupmy[idi]['size']==2){
return true;
}
}
return false;
}
function add_f(id,name,size){
for (idi = 0;idi < groupmy.length; idi++) {
if(groupmy[idi]['id']==id){groupmy.splice(idi,1);}
}
if(size=='add'){
var news_sub={
 id:id,
 name:name,
 size:2
 }
groupmy.push(news_sub);  
}
localStorage.setItem("groupmy"+apiid,JSON.stringify(groupmy)); 
}
var isArray = function(obj) { 
return Object.prototype.toString.call(obj) === '[object Array]'; 
} 
function share(share_mode,share_size){
var share_param = {
URL: www+share_size+'/'+datalook[datalook.length-1]['id']+'.html',
TITLE: (share_size == 't') ?datalook[datalook.length-1]['title']:datalook[datalook.length-1]['summary'],
DESCRIPTION: (share_size == 't') ?datalook[datalook.length-1]['title']:datalook[datalook.length-1]['summary'],
SOURCE: 'ysv8.com' ,
SITE_URL: 'ysv8.com', 
IMAGE: '' ,
WEIBOKEY: '' ,
};
var share_link={qzone:"http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url={{URL}}&title={{TITLE}}&desc={{DESCRIPTION}}&summary={{SUMMARY}}&site={{SOURCE}}",qq:"http://connect.qq.com/widget/shareqq/index.html?url={{URL}}&title={{TITLE}}&source={{SOURCE}}&desc={{DESCRIPTION}}&pics={{IMAGE}}",tencent:"http://share.v.t.qq.com/index.php?c=share&a=index&title={{TITLE}}&url={{URL}}&pic={{IMAGE}}",weibo:"http://service.weibo.com/share/share.php?url={{URL}}&title={{TITLE}}&pic={{IMAGE}}&appkey={{WEIBOKEY}}",wechat:"javascript:;",douban:"http://shuo.douban.com/!service/share?href={{URL}}&name={{TITLE}}&text={{DESCRIPTION}}&image={{IMAGE}}&starid=0&aid=0&style=11",diandian:"http://www.diandian.com/share?lo={{URL}}&ti={{TITLE}}&type=link",linkedin:"http://www.linkedin.com/shareArticle?mini=true&ro=true&title={{TITLE}}&url={{URL}}&summary={{SUMMARY}}&source={{SOURCE}}&armin=armin",facebook:"https://www.facebook.com/sharer/sharer.php?u={{URL}}",twitter:"https://twitter.com/intent/tweet?text={{TITLE}}&url={{URL}}&via={{SITE_URL}}",google:"https://plus.google.com/share?url={{URL}}"}
var mylink=share_link[share_mode];
for(var i in share_param) {
 if(Object.prototype.hasOwnProperty.call(share_param,i)) { //过滤
mylink=mylink.replace('{{'+i+'}}',encodeURIComponent(share_param[i]))
 }
 }
mui.openWindow({url: mylink, id:mylink});
 }
openurl=function(url,id){
mui.openWindow({url: url,id:id
 });
};
setuserdata=function(data){
if(document.getElementById('user_gold')) document.getElementById('user_gold').innerHTML=data['gold'];
if(document.getElementById('user_vip')) document.getElementById('user_vip').innerHTML=data['credits'];
if(document.getElementById('user_credits')) document.getElementById('user_credits').innerHTML=data['credits'];
if(document.getElementById('user_group')) document.getElementById('user_group').innerHTML=data['group'];
if(document.getElementById('user_email')) document.getElementById('user_email').innerHTML=data['email'];
if(document.getElementById('head-img')) document.getElementById('head-img').src=bucketcdn+data['avatar'];
if(document.getElementById('head-img1')) document.getElementById('head-img1').src=bucketcdn+data['avatar'];
if(document.getElementById('username')) document.getElementById('username').innerHTML=data['user'];
if(document.getElementById('username1')) document.getElementById('username1').innerHTML=data['user'];
if(document.getElementById('userimg')) document.getElementById('userimg').src=bucketcdn+data['avatar'];
if(document.getElementById('usermess')) document.getElementById('usermess').innerHTML=data['mess'];
};
muialert=function(data){
 if(typeof(data['link'])=="undefined"){
mui.alert(data['info'],'error');
 }else if(data['link']=='/user/login'){
ysv8hex='no';
localStorage.setItem("ysv8hex"+apiid,'no');
mui.alert(data['info'],l[lang]['警告'],l[lang]['登录'],function(data){
openurl('setting.html','setting');
});
}else if(data['link']=='/gold/cz.html'){
mui.alert(data['info'],l[lang]['警告'],l[lang]['充值'],function(data){
openurl('gold.html','gold');
});
}else if(data['link']=='cz.html'){
mui.alert(data['info'],l[lang]['警告'],l[lang]['充值'],function(data){
openurl('cz.html','cz');
});
}else{
mui.alert(data['info'],'error');
}
}
imgerror=function (self){self.src='img/300300.png';}