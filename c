やりたいこと	MVC	方法	備考
postデータの取り方	C	"$this->request->data['title'];

dataの中にPostデータが入っている"	http://book.cakephp.org/3.0/ja/controllers/request-response.html#post
表示するViewを指定する	C	"$this->render('/Login/Login');

src\TemplateフォルダのLogin\Login.ctpが表示されるようになる
※デフォルトはsrc\Templateフォルダのコントローラー名\アクション名.ctpが表示される"	http://book.cakephp.org/3.0/ja/controllers.html#id6
複数Submitの時のactionの指定	VC	JSでformのactionを書き換える	
Getリンク	V	"<?= $this->Html->link($article->title, ['action' => 'view', $article->id]) ?>

自コントローラーのViewアクションへGetする
 $article->idはパラメータ"	http://book.cakephp.org/3.0/en/tutorials-and-examples/blog/part-two.html
"2byte文字をDBへ登録する
ブログチュートリアルでは登録できなかった"	DB	"文字コードがutf8になっていない箇所をutf8に変更しテーブルを作りなおす

ALTER DATABASE admin default character set sjis;
set character_set_server = sjis;"	"OS:EUC
DB:sjis
HTML:sjis"
confirm付きのリンク	V	"<?= $this->Form->postLink(
                '削除',
                ['action' => 'delete', $article->id],
                ['confirm' => '「' . $article->id . '」を削除してもよろしいでしょうか？'])
            ?>"	
標準のメッセージ出力	VC	"・メッセージを設定
$this->Flash->set('message');

・任意の場所に標準メッセージを出力する
<?= $this->Flash->render() ?>"	http://book.cakephp.org/3.0/en/views/helpers/flash.html
ログ出力	C	"use Cake\Log\Log;
Log::write('debug', print_r('index', true));

logフォルダのdebug.logに出力される"	http://qiita.com/uedatakeshi/items/6cc2d7bfd4e314ca7927
フォームヘルパー	V	"URL参照

echo $this->Form->text('mailaddr', ['maxlength' => '10', 'style' => 'width:120px;', 'value' => '""><b>あ</b><""']);

これで""が&quot;にエンコードされて出力された"	http://book.cakephp.org/3.0/en/views/helpers/form.html
SQLインジェクションは問題ないか	M	動かしてみた感じでは大丈夫そう	
HTMLエンコード	V	h()	http://koseki.hatenablog.com/entry/20120216/htmlspecialhonyarara
独自SQLの実行	M	"$results = $connection
    ->execute('SELECT * FROM articles WHERE id = :id', ['id' => 1]);

戻り値はPDOの結果になる"	"http://book.cakephp.org/3.0/en/orm/database-basics.html
http://m-shige1979.hatenablog.com/entry/2014/06/20/080000"
Sessionの使い方	MVC	"$this->Session = $this->request->session();

・セッションへ書き込み
$this->Session->write('name', 'TEST');

・セッションから読み込み
$this->Session->read('name');"	"http://book.cakephp.org/3.0/en/development/sessions.html
Accessing the Session Object

英語版と日本語版とで記述内容に違いがある
英語版が3.x
日本語版が2.x
の記述になているもよう

Viewでも使用できる"
Sessionの設定		"・App.phpの'Session'に設定をする
    'Session' => [
        'defaults' => 'php',
         'timeout' => 1,
    ],

1分でセッションが破棄される"	http://book.cakephp.org/3.0/ja/development/sessions.html#id2
"beforeFilter
afterFilter"	C	"use Cake\Event\Event;

・actionの開始前に実行される
public function beforeFilter(Event $event) {
}

・actionの終了後に実行される
public function afterFilter(Event $event) {
}"	"http://book.cakephp.org/3.0/en/controllers/components.html
Event引数が無いとエラーになる"
"取得したBLOB型の値がResource id　#185
になっている（文字化け）"	M	"・BLOB型のカラムを文字列にcastする
select cast(password as char character set sjis) from admin_users

$data = $this->connection()->execute('SELECT email, name, cast(password as char character set sjis) AS password, section, has_dime_privilege, regist_date, update_date, delete_date FROM admin_users WHERE email = :email;', ['email' => $email]);"	http://qiita.com/mt_enokida/items/c45259b1a2d3b1552a65
独自バリデーション	V	"            $validator = new Validator();
            $validator
                ->requirePresence('email')
                ->notEmpty('email', 'EMAILを入力してください')
                ->add('email', 'validFormat', ['rule' => 'email', 'message' => 'EMAILにはメールアドレスの形式で入力してください'])
                ->requirePresence('password')
                ->notEmpty('password', 'パスワードを入力してください');

            $validateEntity = ['email' => $email, 'password' => $password];
            $errors = $validator->errors($validateEntity);
            //$errors = $validator->errors($this->request->data());
            if (!empty($errors)) {
                Log::write('debug', print_r('エラー', true));
                Log::write('debug', print_r($errors, true));
            }"	http://m-shige1979.hatenablog.com/entry/2014/06/28/080000
Getパラメータ付きリンク	V	<?= $this->Html->link($user['email'], ['action' => 'view', '?' => ['email' => $user['email']]]) ?>	http://book.cakephp.org/2.0/ja/core-libraries/helpers/html.html
coutSQL	M	"$exists = $adminUsers->find()->where(['email' => $email, 'delete_date IS ' => NULL])->count();

戻り値がint型になる"	http://book.cakephp.org/3.0/en/orm/retrieving-data-and-resultsets.html#getting-a-count-of-results
AS指定を無効にする	C	"$userList = $this->paginate($adminUsers->find()->select(['AdminUsers__regist_date' => 'DATE_FORMAT(AdminUsers.regist_date, \'%Y/%m/%d %H:%i:%s\')']));

カラムを MyModel__MyField の形式で別名にする必要がある"	http://book.cakephp.org/2.0/ja/models/virtual-fields.html#sql
複数チェックボックスの作り方	V	"$options = array(
    'Value 1' => 'Label 1',
    'Value 2' => 'Label 2'
);
echo $this->Form->select('Model.field', $options, array(
    'multiple' => 'checkbox'
));

・valueで選択状態にすることができる
$this->Form->select('subsystems', $subsys, ['multiple' => 'checkbox', 'value' => [2]]);"	http://book.cakephp.org/2.0/ja/core-libraries/helpers/form.html
配列の追加		"$subsys = [];
$subsys = $subsys + [$subsystem->subsystem_id => $subsystem->subsyste_name];"	"http://qiita.com/kazu56/items/6947a0e4830eb556d575
※2の方"
トランザクション	C	" // トランザクション開始
 $this->Users->connection()->begin();

 if ($this->Users->save($user)) {
     $this->Flash->success('The user has been saved.');

     // コミット
     $this->Users->connection()->commit();
 } else {
     // バリデーションエラー表示
     debug($user->errors());
     $this->Flash->error('The user could not be saved. Please, try again.');
     // ロールバック
     $this->Users->connection()->rollback();
 }"	"http://pk-brothers.com/1751/
http://book.cakephp.org/3.0/en/orm/database-basics.html
http://blog.bs-factory.jp/2015/04/cakephp.html"
DBの接続先を変える	M	"・Modelのinitializeメソッドでconnectionを変える
    public function initialize(array $config)
    {
        $conn = ConnectionManager::get('default');
        $this->connection($conn);
    }"	http://book.cakephp.org/3.0/en/orm/database-basics.html#Managing Connections
バリデーションの指定	C	"$adminUser = $this->adminUsers->newEntity($this->request->data, ['validate' => 'Update']);

validationUpdateが呼ばれるようになる"	http://bakery.cakephp-users.jp/2015/01/06/cakephp_3_0_0-rc1_released/
正規表現のバリデーション	M	"        $validator
            ->add('password', 'valid', ['rule' => ['custom','/[a-z0-9]{3,}$/i'], 'message' => 'パスワード正規表現エラー'])
            ->notEmpty('password');"	http://book.cakephp.org/1.3/ja/The-Manual/Common-Tasks-With-CakePHP/Data-Validation.html#id5
"独自Functionをバリデーションルールで使用する

独自チェック"	M	        $validator->add('password', 'confirm', ['rule' => [$this, 'confirmPassword'], 'message' => 'パスワード独自チェックエラー'])	http://book.cakephp.org/3.0/en/core-libraries/validation.html#custom-validation-rules
パスワードを保存しますかを出さなくさせる	V	<input type="text" name="field1" value="" autocomplete="off">	http://kawama.jp/archives/2009/01/29/html_1.html
APPとかのパスを変える		"composer.jsonを修正してコマンド実行

cd /var/www/admin.docomo.biz/https/htdocs/TOOLS
/usr/local/bin/composer.phar dumpautoload"	"http://book.cakephp.org/3.0/en/development/configuration.html#additional-class-paths
http://blog.open.tokyo.jp/2014/03/30/composer-autoload.html"
composer.jsonの設定		"・複数のパス指定
    ""autoload"": {
        ""psr-4"": {
            ""App\\"": [""src"",""src/Admin"",""src/Test""]
        }
    },"	http://tec-blog.beaglee.com/?p=232
ページャーのページ番号のオプション		"・仕様が変わったオプションは下、テンプレートを用意するらしい

'before' => null, 
'after' => null, 
'modulus' => 8, 
'first' => null, 
'last' => null,

テンプレートは
/config/paginator-templates.php

コントローラーで使用するテンプレートを設定する
public $helpers = [
        'Paginator' => ['templates' => 'paginator-templates']
    ];"	"http://qiita.com/satthi/items/af24c10d083e21f49906
"
定数定義		"定数は
/config/AdminConst.php

bootstrap.phpで↑を読み込む

$config['__dummy__'] = '';を定義しないとConfigure::loadでエラーになる"	"http://hakomori.net/cakephp-original-constant/
http://mocha.exblog.jp/12609304/
http://www.junk-port.com/cakephp/define/
http://blog.fagai.net/2015/01/18/cakephp3-configure-class/"
post有効期限切れを回避する方法		"これってページがキャッシュされてしまうのでは？


// 戻るボタンで戻れるようにするための対応。
$date_today = mktime (0, 0, 0, date(""m""), date(""d""),  date(""y""));
$date_tomorrow = $date_today + 86400;
date(DATE_RFC1123, $date_tomorrow);

header('Cache-Control: max-age=' . ($date_tomorrow - time()));
if (session_id()) {
  header('Expires: ' . date(DATE_RFC1123, $date_tomorrow));
  header('Pragma: cache');    // Pragmaにはno-cache以外の設定値はないが、Firefox対応のため適当な文字列を設定する。
}

これだけにする？
$this->response->header('Cache-Control', 'private');"	"http://trivia.cocolog-nifty.com/blog/php/index.html
http://d.hatena.ne.jp/shinyanakao/20080313/1205396128"
ページをキャッシュさせない	V	"<meta http-equiv=""Pragma"" content=""no-cache"">
<meta http-equiv=""Cache-Control"" content=""no-cache"">"	http://www.tagindex.com/html_tag/page/meta_pragma.html
responseのheader操作		$this->response->header('Location', 'http://example.com');	http://book.cakephp.org/3.0/en/controllers/request-response.html#setting-headers
