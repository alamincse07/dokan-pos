<?php

class ArticlesController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = "//layouts/simple-portal";

    /**
     * @return array action filters
     */
    public function filters()
    {
        return [
            "accessControl", // perform access control for CRUD operations
            "postOnly + delete", // we only allow deletion via POST request
        ];
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        //die($this->action->id);
        return [
            [
                "allow", // allow admin user to perform 'admin' and 'delete' actions
                //'actions'=>$this->getAction(),
                "actions" => $this->getActions(),
                "users" => $this->getAccess(),
            ],
            [
                "deny", // deny all users
                "users" => ["*"],
            ],
        ];
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render("view", [
            "model" => $this->loadModel($id),
        ]);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Articles();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST["Articles"])) {
            $model->attributes = $_POST["Articles"];
            if ($model->save()) {
                $this->redirect(["view", "id" => $model->id]);
            }
        }

        $this->render("create", [
            "model" => $model,
        ]);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionIndex()
    {
        if (isset($_REQUEST["cat"])) {
            $where = " where category like '" . $_REQUEST["cat"] . "'";
            $selected = strtoupper($_REQUEST["cat"]);
        } else {
            $where = " ";
            $selected = "";
        }
        // $where=" ";
        $ar_q = "SELECT DISTINCT(article) FROM articles " . $where . "  ";
        //DIE($ar_q);
        $res_all = Yii::app()
            ->db->createCommand($ar_q)
            ->queryAll();
        //$res_all = $res_ar_q->fetch_all(MYSQLI_ASSOC);
        $all_articles = '<option value="">Select</option>';
        //die(print_r($sells_mana));
        foreach ($res_all as $k => $val) {
            //print $val['member_name'];
            $all_articles .=
                '<option value="' .
                $val["article"] .
                '">' .
                $val["article"] .
                "</option>";
        }
        $html =
            '<select style="min-width: 220px; float: right;" id="common_article" onchange="GetPrice(this)" name="stock_article"  size="1">

                    ' .
            $all_articles .
            '

                </select>';

        die(json_encode(["options" => $html]));
    }
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST["Articles"])) {
            $model->attributes = $_POST["Articles"];

            if ($model->save()) {
                $this->redirect(["view", "id" => $model->id]);
            }
        }

        $this->render("update", [
            "model" => $model,
        ]);
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET["ajax"])) {
            $this->redirect(
                isset($_POST["returnUrl"]) ? $_POST["returnUrl"] : ["admin"]
            );
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex1()
    {
        $dataProvider = new CActiveDataProvider("Articles");
        $this->render("index", [
            "dataProvider" => $dataProvider,
        ]);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Articles("search");
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET["Articles"])) {
            $model->attributes = $_GET["Articles"];
        }

        $this->render("admin", [
            "model" => $model,
        ]);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Articles::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, "The requested page does not exist.");
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST["ajax"]) && $_POST["ajax"] === "articles-form") {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAdd()
    {
        $msg = "";
        $db = Yii::app()->db;
        if (isset($_POST["stock_article__sexyCombo"])) {
            // die(print_r($_POST));//
            if (
                isset($_POST["stock_article__sexyCombo"]) &&
               ( $_POST["stock_article__sexyCombo"] == "" ||  $_POST["stock_article__sexyCombo"] == "Select")
            ) {
                $msg = "Please Give Article";
                               
            } elseif (
                isset($_POST["article_pair"]) &&
                $_POST["article_pair"] == ""
            ) {
                $msg = "মোট জোড়া দিন";
            } 
            elseif($_REQUEST['autoArticle'] ==1 && $_REQUEST['hint__sexyCombo']==''){
                $msg = "বক্সের উপর লেখ";
               }

            
            elseif (
                strtoupper($_REQUEST["category_stock"]) == "VRC" ||
                strtoupper($_REQUEST["category_stock"]) == "STAR" ||
                strtoupper($_REQUEST["category_stock"]) == "CSS"
            ) {
                if (
                    isset($_POST["article_total_taka"]) &&
                    $_POST["article_total_taka"] == "" &&
                    (isset($_POST["article_actual_rate"]) &&
                        $_POST["article_actual_rate"] == "")
                ) {
                    $msg = "মোট কেনাদাম দিন";
                } else {
                    $msg = "ok";
                }
            } elseif (
                isset($_POST["article_body_rate"]) &&
                $_POST["article_body_rate"] == "" &&
                (strtoupper($_REQUEST["category_stock"]) == "DSR" ||
                    strtoupper($_REQUEST["category_stock"]) == "ESR" ||
                    strtoupper($_REQUEST["category_stock"]) == "CSS")
            ) {
                $msg = "বডিরেট দিন";
            } elseif (
                isset($_POST["article_body_rate"]) &&
                $_POST["article_body_rate"] == "" &&
                strtoupper($_REQUEST["category_stock"]) == "BATA"
            ) {
                $msg = "বডিরেট দিন";
            } elseif (
                isset($_POST["article_body_rate"]) &&
                $_POST["article_body_rate"] == "" &&
                strtoupper($_REQUEST["category_stock"]) == "APEX"
            ) {
                $msg = "বডিরেট দিন";
            } elseif (
                isset($_POST["percentage"]) &&
                $_POST["percentage"] == "" &&
                (strtoupper($_REQUEST["category_stock"]) == "BATA" ||
                    strtoupper($_REQUEST["category_stock"]) == "APEX")
            ) {
                $msg = "কমিশন %  দিন";
            } else {
                $msg = "ok";
            }

            if ($msg == "ok") {
                //insert

                $article = addslashes(
                    trim(strtoupper($_REQUEST["stock_article__sexyCombo"]))
                );
                $category = addslashes(
                    trim(strtoupper($_REQUEST["category_stock"]))
                );
                $pair = addslashes(trim(strtoupper($_REQUEST["article_pair"])));
                // $orginal_article =  addslashes(trim(strtoupper($_REQUEST['orginal_article'])));
                $orginal_article = "n/a";

                if (strtoupper($category == "JSR")) {
                    $percentage = 0.18;
                    $body_rate = addslashes(
                        trim(strtoupper($_REQUEST["article_body_rate"]))
                    );

                    $actual_rate =
                        $body_rate - intval(ceil($body_rate * $percentage));

                    $total_taka = $actual_rate * $pair;
                } elseif (
                    strtoupper($category) == "DSR" ||
                    strtoupper($category) == "ESR"
                ) {
                    $percentage = 0.28;

                    $body_rate = addslashes(
                        trim(strtoupper($_REQUEST["article_body_rate"]))
                    );

                    $actual_rate =
                        $body_rate - intval(ceil($body_rate * $percentage));

                    $total_taka = $actual_rate * $pair;

                    if (
                        isset($_POST["article_body_rate"]) &&
                        $_POST["article_body_rate"] == ""
                    ) {
                        $msg = "Please Give body rate";
                    }
                } elseif (
                    strtoupper($category == "BATA") ||
                    strtoupper($category == "APEX") ||
                    strtoupper($category == "PEGA") ||
                    strtoupper($category == "LOTTO")
                ) {
                    $percentage = ($_POST["percentage"] * 1) / 100;

                    // Generic::_setTrace($percentage);
                    $body_rate = addslashes(
                        trim(strtoupper($_REQUEST["article_body_rate"]))
                    );

                    $actual_rate =
                        $body_rate - intval(ceil($body_rate * $percentage));

                    $total_taka = $actual_rate * $pair;

                    if (
                        isset($_POST["article_body_rate"]) &&
                        $_POST["article_body_rate"] == ""
                    ) {
                        $msg = "Please Give body rate";
                    }
                } else {
                    $total_taka = addslashes(
                        trim(strtoupper(@$_REQUEST["article_total_taka"]))
                    );
                    $actual_rate = addslashes(
                        trim(strtoupper(@$_REQUEST["article_actual_rate"]))
                    );
                    $body_rate = addslashes(
                        trim(strtoupper(@$_REQUEST["article_body_rate"]))
                    );

                    if ($actual_rate != "" && $actual_rate * 1 > 0) {
                        $total_taka = $actual_rate * $pair;
                    } else {
                        if (is_numeric($total_taka)) {
                            $actual_rate = intval(ceil($total_taka / $pair));
                        } else {
                            $actual_rate = 0;
                            $msg = "মোট কেনাদাম দিন";
                        }
                    }
                }

                //$body_rate =  addslashes(trim(strtoupper($_REQUEST['article_body_rate'])));

               

                // $sql=" Insert into articles set article='$article', category='$category', total_pair=$pair, total_taka=$total_taka,actual_price='$actual_rate',body_rate='$body_rate',added_date=NOW(),last_added_pair=$pair,last_added_taka=$total_taka, orginal_article='$orginal_article' on duplicate key update body_rate=$body_rate , total_pair=(total_pair+$pair), total_taka=(total_taka+$total_taka),added_date=NOW(),last_added_pair=$pair,last_added_taka=$total_taka".$upacp.";";
                $sql2 = " Insert into last_added_items set article='$article', category='$category', total_pair=$pair, total_taka=$total_taka,actual_price='$actual_rate',body_rate='$body_rate',added_date=NOW(),last_added_pair=$pair,last_added_taka=$total_taka, orginal_article='$orginal_article' on duplicate key update  total_pair=(total_pair+$pair), total_taka=(total_taka+$total_taka),added_date=NOW(),last_added_pair=$pair,last_added_taka=$total_taka;";

                $res = 0;
                if ($msg == "ok") {
                    $is_new_record = false;
                    $model = Articles::model()->findByAttributes([
                        "article" => $article,
                    ]);
                    $body_rate = intval($body_rate) * 1;
                    if ($model) {
                        if($_REQUEST['autoArticle'] ==1){
                            die(json_encode(["status" => "Article can't be auto", "info" => $_REQUEST]));
                        }
                        $model->body_rate = $body_rate;
                        $model->total_pair = $model->total_pair + $pair;
                        $model->total_taka = $model->total_taka + $total_taka;
                        $model->added_date = date('Y-m-d');
                        $model->last_added_pair = $pair;
                        $model->last_added_taka = $total_taka;
                        $model->increment = $actual_rate - $model->actual_price;
                        $model->actual_price =
                            $model->actual_price < $actual_rate * 1
                                ? $actual_rate
                                : $model->actual_price;
                    } else {
                       
                        $model = new Articles();
                        $is_new_record = true;
                        $model->body_rate = $body_rate;
                        $model->article = $article;
                        $model->category = $category;
                        $model->article = $article;
                        $model->total_pair = $pair;
                        $model->total_taka = $total_taka;
                        $model->actual_price = $actual_rate;
                        $model->added_date = date('Y-m-d');
                        $model->last_added_pair = $pair;
                        $model->last_added_taka = $total_taka;
                    }

                    // file_put_contents("article-$time2.txt","\n\r".$sql,FILE_APPEND);
                    // file_put_contents("last-added-$time2.txt","\n\r".$sql2,FILE_APPEND);

                    if ($model->save()) {
                        $res = Yii::app()
                            ->db->createCommand($sql2)
                            ->execute();
                        $_REQUEST["last_insert_id"] = $is_new_record
                            ? $model->id
                            : 0;
                        $_REQUEST["actual_rate"] = "";
                        if (
                            $category == "VRC" ||
                            $category == "STAR" ||
                            $category == "CSS" ||
                            $category == "INDIAN"
                        ) {
                            $_REQUEST["actual_rate"] = $actual_rate;
                        }

                        $msg ='added';
                    } else {
                        $msg = trim("Error happens: " . json_encode(['error'=>$model->errors]));
                    }
                } else {
                    // show message
                }
            }

            if (Yii::app()->request->isAjaxRequest) {
                die(json_encode(["status" => $msg, "info" => $_REQUEST]));
            }
        }

        $lastId = 0;
        if(isset($_REQUEST['cat']) && in_array($_REQUEST['cat'], ['DSR','ESR', 'STAR', 'CSS'])){

             $lastId =  $lastId = Yii::app()->db->createCommand('SELECT id FROM articles ORDER BY id DESC LIMIT 1')->queryScalar();
        }

            $this->render("add", [
                "msg" => $msg,
                'lastId'=>$lastId
            ]);
        }
    
}
