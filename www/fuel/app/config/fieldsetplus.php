<?php
class Fieldsetplus extends \Fieldset
{
    /**
     * フォーム要素をviewで使いやすい配列で取得
     */
    public function getFormElements($open = '', $hidden = array())
    {
        if (is_array($open)) {
            $attr = $open;
        } else {
            $attr['action'] = $open;
            $attr['method'] = 'post';
        }
        // formのIDは'form_' + fieldsetの名前
        $attr['id'] = 'form_' . $this->get_name();

        // CSRFトークンを加える書きだす
        $hidden[Config::get('security.csrf_token_key')] = Security::fetch_token();

        // hidden + CSRFトークン生成
        $form['form_open'] = $this->form()->open($attr, $hidden);

        //labelマッチングパターン
        $pattern_label = '/<label(.*)<\/label>/';
        $pattern_span = '/<span(.*)<\/span>/';
        // 各要素の生成
        //hierselectが含まれているか否かのフラグ
        $i = 0;
        $flag[$i] = false;
        $js = "";
        foreach ($this->field() as $f) {
            if( count($f->rules) > 0 ){
                $js .= $this->validate_js($f);
            }
            //2014/12/25 枠谷追加　nameに[]があった場合に配列に変換する
            //typeがhierseletの場合、別処理
            if ($f->type === 'hierselect') {
                $form[$f->name]["html"] = $this->add_hierselect($f, $i);

                $flag[$i] = $f->name;
                $i++;
            } else {

                if (strpos($f->name, '[') !== FALSE) {
                    $name = explode("[", $f->name);
                    $sname = $name[0];
                    $key = rtrim($name[1], "]");
                    $form[$sname][$key] = array('label' => $f->label, 'html' => $f->build());
                    //htmlから余計なタグを取り除く
                    if ($f->type == "radio" || $f->type == "checkbox") {
                        $form[$sname][$key]["html"] = preg_replace($pattern_span, '', $form[$sname][$key]["html"]);
                        //それ以外は、<label>を取り除く
                    } else {
                        $form[$sname][$key]["html"] = preg_replace($pattern_label, '', $form[$sname][$key]["html"]);
                    }

                    $form[$sname][$key]["html"] = strip_tags($form[$sname][$key]["html"], "<input><select><option><textarea><label><script>");

                    //$search = array( '*', "\t", "\r", "\n" );
                    $search = array('*', "\t");
                    $form[$sname][$key]["html"] = str_replace($search, "", $form[$sname][$key]["html"]);
                    $form[$sname][$key]["label"] = str_replace($search, "", $form[$sname][$key]["label"]);
                } else {

                    $form[$f->name] = array('label' => $f->label, 'html' => $f->build());
                    //checkbox、radioは<span>を取り除く
                    if ($f->type == "radio" || $f->type == "checkbox") {
                        $form[$f->name]["html"] = preg_replace($pattern_span, '', $form[$f->name]["html"]);
                        //それ以外は、<label>を取り除く
                    } else {
                        $form[$f->name]["html"] = preg_replace($pattern_label, '', $form[$f->name]["html"]);
                    }

                    //htmlから余計なタグを取り除く
                    $form[$f->name]["html"] = strip_tags($form[$f->name]["html"], "<input><select><option><textarea><label><script>");

                    $search = array('*', "\t");
                    $form[$f->name]["html"] = str_replace($search, "", $form[$f->name]["html"]);
                    $form[$f->name]["label"] = str_replace($search, "", $form[$f->name]["label"]);
                }
            }
        }
        if ($flag[0] !== false) {
            $onchange = $flag[0];
            $form['form_open'] = str_replace('">', "\" onreset=\"if (typeof _hs_setupOnReset != 'undefined') { return _hs_setupOnReset(this, ['{$onchange}']); } \">", $form['form_open']);
        }

        // close
        $form['form_close'] = '</form>';

        // エラー取得
        $form['error'] = $this->show_errors();
        if( $js !== "" ){

            $form['js'] = <<<EOD

<script type="text/javascript">
	$(function(){
		var val = "";
		var msg = "";
		$("#{$attr["id"]}").submit(function(){
			{$js}
			if( msg != ""){
				alert(msg);
				val = "";
				msg = "";
				return false;
			}
		});
	});
</script>

EOD;
        }else{
            $form['js'] = "";
        }

        return $form;
    }

    /**
     * 数値の入力を受け付けるinput text要素
     *
     * - 自動的に数値バリデーションが追加される
     * - 自動的にime-modeがdisabledに設定される
     */
    public function addTextForNumeric($name, $label)
    {
        return $this->add(
            $name,
            $label,
            array(
                'class' => 'input-medium',
                'style' => 'ime-mode:disabled'
            )
        )->add_rule('valid_string', 'numeric')->set_template('{field}');
    }

    /**
     * 選択肢を一行で表示するRadio要素
     */
    public function addRadioInline($name, $label, $options)
    {
        return $this->add(
            $name,
            $label,
            array(
                'type' => 'radio',
                'options' => $options,
            )
        )->set_template('{fields}<label class="radio inline">{field}{label}</label>{fields}');
    }

    /**
     * 選択肢を改行するRadio要素
     */
    public function addRadioWithBr($name, $label, $options)
    {
        return $this->add(
            $name,
            $label,
            array(
                'type' => 'radio',
                'options' => $options,
            )
        )->set_template('{fields}<label class="radio">{field}{label}</label>{fields}');
    }

    /**
     * QuickFormのadvcheckboxと同様のcheckbox
     */
    public function add_advcheckbox($name, $label, $options = array())
    {
        foreach ($options as $key => $value) {
            $vals[] = $value;
        }

        $res = $this->add(
            $name,
            $label,
            array(
                'type' => 'checkbox',
                'value' => $vals[0],
            )
        )->set_template('{field}');

        $res .= "\n" . '<input type="hidden" name="' . $name . '" value="' . $vals[1] . '">' . "\n";
        return $res;

    }

    /**
     * QuickFormのhierselectと同様のselectbox
     */
    public function add_hierselect($obj, $i = 0)
    {
        $name = $obj->name;
        $label = $obj->label;
        $options = $obj->options;
        $default = $obj->value;
        $default[0] = (isset($default[0])) ? $default[0] : "0";
        $default[1] = (isset($default[1])) ? $default[1] : "0";

        if (!isset($options[0]) OR !isset($options[1])) return false;
        $opt1 = $options[0];
        $opt2 = $options[1];
        $opt2Str = $this->option_serialize($opt2);

        $label1 = "";
        $label2 = "";
        if (is_array($label) && count($label) === 2) {
            list($label1, $label2) = $label;
            $label1 = (is_null($label1)) ? '' : "<label>{$label1}</label>";
            $label2 = (is_null($label2)) ? '' : "<label>{$label2}</label>";
        }
        //javascript
        $res = <<<EOF
			
<script type="text/javascript">

//<![CDATA[
EOF;
        //一回だけ（if Start）
        if ($i === 0) {
            $res .= <<<EOF
				
function _hs_findOptions(ary, keys)
{
    if (ary == undefined) {
        return {};
    }
    var key = keys.shift();
    if (!key in ary) {
        return {};
    } else if (0 == keys.length) {
        return ary[key];
    } else {
        return _hs_findOptions(ary[key], keys);
    }
}

function _hs_findSelect(form, groupName, selectIndex)
{
    if (groupName+'['+ selectIndex +']' in form) {
        return form[groupName+'['+ selectIndex +']']; 
    } else {
        return form[groupName+'['+ selectIndex +'][]']; 
    }
}

function _hs_unescapeEntities(str)
{
    var div = document.createElement('div');
    div.innerHTML = str;
    return div.childNodes[0] ? div.childNodes[0].nodeValue : '';
}

function _hs_replaceOptions(ctl, options)
{
    var j = 0;
    ctl.options.length = 0;
    for (var i = 0; i < options.values.length; i++) {
        ctl.options[i] = new Option(
            (-1 == String(options.texts[i]).indexOf('&'))? options.texts[i]: _hs_unescapeEntities(options.texts[i]),
            options.values[i], false, false
        );
    }
}

function _hs_setValue(ctl, value)
{
    var testValue = {};
    if (value instanceof Array) {
        for (var i = 0; i < value.length; i++) {
            testValue[value[i]] = true;
        }
    } else {
        testValue[value] = true;
    }
    for (var i = 0; i < ctl.options.length; i++) {
        if (ctl.options[i].value in testValue) {
            ctl.options[i].selected = true;
        }
    }
}

function _hs_swapOptions(form, groupName, selectIndex)
{
    var hsValue = [];
    for (var i = 0; i <= selectIndex; i++) {
        hsValue[i] = _hs_findSelect(form, groupName, i).value;
    }

    _hs_replaceOptions(_hs_findSelect(form, groupName, selectIndex + 1), 
                       _hs_findOptions(_hs_options[groupName][selectIndex], hsValue));
    if (selectIndex + 1 < _hs_options[groupName].length) {
        _hs_swapOptions(form, groupName, selectIndex + 1);
    }
}

function _hs_onReset(form, groupNames)
{
    for (var i = 0; i < groupNames.length; i++) {
        try {
            for (var j = 0; j <= _hs_options[groupNames[i]].length; j++) {
                _hs_setValue(_hs_findSelect(form, groupNames[i], j), _hs_defaults[groupNames[i]][j]);
                if (j < _hs_options[groupNames[i]].length) {
                    _hs_replaceOptions(_hs_findSelect(form, groupNames[i], j + 1), 
                                       _hs_findOptions(_hs_options[groupNames[i]][j], _hs_defaults[groupNames[i]].slice(0, j + 1)));
                }
            }
        } catch (e) {
            if (!(e instanceof TypeError)) {
                throw e;
            }
        }
    }
}

function _hs_setupOnReset(form, groupNames)
{
    setTimeout(function() { _hs_onReset(form, groupNames); }, 25);
}

function _hs_onReload()
{
    var ctl;
    for (var i = 0; i < document.forms.length; i++) {
        for (var j in _hs_defaults) {
            if (ctl = _hs_findSelect(document.forms[i], j, 0)) {
                for (var k = 0; k < _hs_defaults[j].length; k++) {
                    _hs_setValue(_hs_findSelect(document.forms[i], j, k), _hs_defaults[j][k]);
                }
            }
        }
    }

    if (_hs_prevOnload) {
        _hs_prevOnload();
    }
}

var _hs_prevOnload = null;
if (window.onload) {
    _hs_prevOnload = window.onload;
}
window.onload = _hs_onReload;

var _hs_options = {};
var _hs_defaults = {};
EOF;
        }//一回だけ（if End）

        $res .= <<<EOF
			
_hs_options['{$name}'] = [
{$opt2Str}
];
_hs_defaults['{$name}'] = ['{$default[0]}','{$default[1]}'];
//]]>

</script>
	
EOF;
        $name1 = "{$name}[0]";
        $res .= "\n" . $label1;
        $res .= $this->add(
            $name1,
            $label1,
            array(
                'type' => 'select',
                'options' => $opt1,
                'onchange' => "_hs_swapOptions(this.form, '{$name}', 0);",
            )
        )->set_template('{field}');

        $res .= "\n";

        $name2 = "{$name}[1]";

        $opt2[$default[0]] = (isset($opt2[$default[0]])) ? $opt2[$default[0]] : '';

        $res .= "\n" . $label2;
        $res .= $this->add(
            $name2,
            $label2,
            array(
                'type' => 'select',
                'options' => $opt2[$default[0]],
            )
        )->set_template('{field}');

        $res .= "\n";

        return $res;

    }

    /**
     * hierselectの第二オプションを成形する
     */
    private function option_serialize($opt2 = false)
    {
        if ($opt2 === false) return false;

        $res = array();
        foreach ($opt2 as $key => $value) {
            $valuesStr = implode(',', array_keys($value));
            $textsStr = "'" . implode("','", $value) . "'";
            $res[] = "'" . $key . "':{'values':[" . $valuesStr . "],'texts':[" . $textsStr . "]}";
        }

        $resStr = implode(',', $res);
        $resStr = '{' . $resStr . '}';
        return $resStr;
    }

    /**
     * フォームを固定する
     *
     * public $isFreeze = false;
     * protected static $valuesBeforeFreeze = array();
     * protected static $widgetSchemaBeforeFreeze = null;
     *
     * public function setHiddenAll()
     * {
     * self::$valuesBeforeFreeze = $this->getValues();
     * self::$widgetSchemaBeforeFreeze = clone $this->getWidgetSchema();
     * foreach ($this->getWidgetSchema()->getFields() as $id => $v) {
     * // CSRF token is set by automate, so except !
     * if ($this->getCSRFFieldName() == $id) continue;
     * $this->widgetSchema[$id] = new sfWidgetFormInputHidden(array(), array('value' => $this->getValue($id)));
     * }
     * }
     *
     * public function unfreeze()
     * {
     * $this->setwidgetSchema(self::$widgetSchemaBeforeFreeze);
     * $this->setDefaults(self::$valuesBeforeFreeze);
     * $this->isFreeze = false;
     * }
     * public function freeze()
     * {
     * $this->setHiddenAll();
     * $this->isFreeze = true;
     * }*/

    //バリデーション用Jqueryのコードを出力しようかと思う
    private function validate_js($obj){
        $js = "";
        foreach ( $obj->rules as $value) {
            if( $value[0] !== "" ){
                switch($value[0]){
                    //必須の場合
                    case 'required':
                        $js .= <<<EOD

val = $('input[name="{$obj->name}"]').val();
if( typeof val != "undefined"){
if(val === "" ){
EOD;
                        if( isset($value[1]) && !empty($value[1]) ){
                            $js .= <<<EOD

	msg += "{$value[1]}\\n";
EOD;
                        }else{
                            $js .= <<<EOD

	msg += "{$obj->label}は入力必須です。\\n";
EOD;
                        }
                        $js .=  <<<EOD

}
}
EOD;
                        break;
                    //数値のみ
                    case 'numeric':
                        $js .= <<<EOD

val = $('input[name="{$obj->name}"]').val();
if( typeof val != "undefined"){
if(val.match(/[^0-9]+/) ){
EOD;
                        if( isset($value[1]) && !empty($value[1]) ){
                            $js .= <<<EOD

	msg += "{$value[1]}\\n";
EOD;
                        }else{
                            $js .= <<<EOD

	msg += "{$obj->label}は数値のみ入力可能です。\\n";
EOD;
                        }
                        $js .=  <<<EOD

}
}

EOD;
                        break;
                    //メールアドレスのみ
                    case 'valid_email':
                        $js .= <<<EOD

val = $('input[name="{$obj->name}"]').val();
if( typeof val != "undefined"){
if( !val.match(/^[A-Za-z0-9]+[\w-]+@[\w\.-]+\.\w{2,}$/) ){
EOD;
                        if( isset($value[1]) && !empty($value[1]) ){
                            $js .= <<<EOD

	msg += "{$value[1]}\\n";
EOD;
                        }else{
                            $js .= <<<EOD

	msg += "{$obj->label}はメールアドレスのみ入力可能です。\\n";
EOD;
                        }
                        $js .=  <<<EOD

}
}
EOD;
                        break;
                    //URLのみ
                    case 'valid_url':
                        $js .= <<<EOD
val = $('input[name="{$obj->name}"]').val();
if( typeof val != "undefined"){
if( !val.match(/^(https?|ftp)(:¥/¥/[-_.!~*¥'()a-zA-Z0-9;¥/?:¥@&=+¥$,%#]+)$/) ){
EOD;
                        if( isset($value[1]) && !empty($value[1]) ){
                            $js .= <<<EOD

	msg += "{$value[1]}\\n";
EOD;
                        }else{
                            $js .= <<<EOD

	msg += "{$obj->label}はURLのみ入力可能です。\\n";
EOD;
                        }
                        $js .=  <<<EOD

}
}
EOD;
                        break;
                    //電話番号（数字のみか-）
                    case 'valid_tel':
                        $js .= <<<EOD

val = $('input[name="{$obj->name}"]').val();
if( typeof val != "undefined"){
if(val.match(/[^0-9-]+/) ){
EOD;
                        if( isset($value[1]) && !empty($value[1]) ){
                            $js .= <<<EOD

	msg += "{$value[1]}\\n";
EOD;
                        }else{
                            $js .= <<<EOD

	msg += "{$obj->label}は数値のみかハイフン含む数値のみ入力可能です。\\n";
EOD;
                        }
                        $js .=  <<<EOD

}
}

EOD;
                        break;
                    //桁数指定
                    case 'extact_length':
                        if( isset($value[1][0]) && isset($value[1][1]) ){
                            list($length, $msg) = $value[1];
                        }elseif( isset($value[1][0]) && !isset($value[1][1]) ){
                            $length = $value[1][0];
                            $msg = null;
                        }elseif( !isset($value[1][0]) && !isset($value[1][1]) ){
                            $length = 1;
                            $msg = null;
                        }
                        $js .= <<<EOD

val = $('input[name="{$obj->name}"]').val();
if( typeof val != "undefined"){
if(val.length != {$length}){
EOD;
                        if( isset($msg) && !empty($length) ){
                            $js .= <<<EOD

	msg += "{$length}\\n";
EOD;
                        }else{
                            $js .= <<<EOD

	msg += "{$obj->label}は{$length}文字で入力して下さい。\\n";
EOD;
                        }
                        $js .=  <<<EOD

}
}

EOD;
                        break;
                    //半角英数字のみ
                    case 'valid_alphabet_num':
                        if( isset($value[1][0]) && isset($value[1][1]) ){
                            list($min, $msg) = $value[1];
                        }elseif( isset($value[1][0]) && !isset($value[1][1]) ){
                            $min = $value[1][0];
                            $msg = null;
                        }elseif( !isset($value[1][0]) && !isset($value[1][1]) ){
                            $min = 1;
                            $msg = null;
                        }
                        $js .= <<<EOD

val = $('input[name="{$obj->name}"]').val();
if( typeof val != "undefined"){
if(val.match(/^[a-zA-Z0-9]+/) && val.length < {$min}){
EOD;
                        if( isset($msg) && !empty($msg) ){
                            $js .= <<<EOD

	msg += "{$msg}\\n";
EOD;
                        }else{
                            $js .= <<<EOD

	msg += "{$obj->label}は{$min}文字以上の半角英数字で入力して下さい。\\n";
EOD;
                        }
                        $js .=  <<<EOD

}
}

EOD;
                        break;
                    //checkboxで最小チェックが必要の場合
                    case 'min_check':
                        if( isset($value[1][0]) && isset($value[1][1]) ){
                            list($min, $msg) = $value[1];
                        }elseif( isset($value[1][0]) && !isset($value[1][1]) ){
                            $min = $value[1][0];
                            $msg = null;
                        }elseif( !isset($value[1][0]) && !isset($value[1][1]) ){
                            $min = 1;
                            $msg = null;
                        }
                        $js .= <<<EOD
	var count = 0;
	$('input[name^="{$obj->name}["]').each(function(){
		if( $(this).prop('checked') ) {
			count = count + 1;
		}
	});
	if( count < $min  ){
EOD;
                        if( isset($min) && !empty($msg) ){
                            $js .= <<<EOD

	msg += "{$msg}\\n";
EOD;
                        }else{
                            $js .= <<<EOD

	msg += "{$obj->label}は少なくとも{$min}個以上チェックして下さい。\\n";
EOD;
                        }
                        $js .=  <<<EOD

}

EOD;
                        break;

                    //checkboxで最大チェック数を判定
                    case 'max_check':
                        if( isset($value[1][0]) && isset($value[1][1]) ){
                            list($max, $msg) = $value[1];
                        }elseif( isset($value[1][0]) && !isset($value[1][1]) ){
                            $max = $value[1][0];
                            $msg = null;
                        }elseif( !isset($value[1][0]) && !isset($value[1][1]) ){
                            $max = 1;
                            $msg = null;
                        }
                        $js .= <<<EOD
	var count = 0;
	$('input[name^="{$obj->name}["]').each(function(){
		if( $(this).prop('checked') ) {
			count = count + 1;
		}
	});
	if( count > $max  ){
EOD;
                        if( isset($max) && !empty($msg) ){
                            $js .= <<<EOD

	msg += "{$msg}\\n";
EOD;
                        }else{
                            $js .= <<<EOD

	msg += "{$obj->label}のチェックは{$max}個以内までにして下さい。\\n";
EOD;
                        }
                        $js .=  <<<EOD

}

EOD;
                        break;
                }
            }
        }
        return $js;

    }
}