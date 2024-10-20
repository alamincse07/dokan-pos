<?php

class ArticlesController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = "//layouts/simple-portal";

    // TODO: make it from DB or config later
    public $categories = [
        [
            "id" => "1",
            "calculation_type" => "PERCENT",
            "name" => "DSR",
            "profit" => "30"
        ],
        [
            "id" => "2",
            "calculation_type" => "PERCENT",
            "name" => "ESR",
            "profit" => "30"
        ],
        [
            "id" => "3",
            "calculation_type" => "PERCENT",
            "name" => "BATA",
            "profit" => "20"
        ],
        [
            "id" => "4",
            "calculation_type" => "FLAT",
            "name" => "VRC",
            "profit" => ""
        ],
        [
            "id" => "5",
            "calculation_type" => "FLAT",
            "name" => "CSS",
            "profit" => ""
        ],
        [
            "id" => "6",
            "calculation_type" => "PERCENT",
            "name" => "APEX",
            "profit" => "20"
        ],
        [
            "id" => "7",
            "calculation_type" => "FLAT",
            "name" => "INDIAN",
            "profit" => ""
        ],
        [
            "id" => "8",
            "calculation_type" => "FLAT",
            "name" => "STAR",
            "profit" => ""
        ],
        [
            "id" => "9",
            "calculation_type" => "PERCENT",
            "name" => "PEGA",
            "profit" => "20"
        ],
        [
            "id" => "10",
            "calculation_type" => "PERCENT",
            "name" => "LOTTO",
            "profit" => "20"
        ]
    ];

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
     * Manages all tags models.
     */
    public function actionSearchByTags()
    {
        
            $data = [];
            if (isset($_GET["tags"])) {
                $tags = $_GET["tags"];
                $tags = explode(',',$tags);
                $tags = array_filter($tags);
                $json = json_encode($tags, JSON_UNESCAPED_UNICODE);
               if(count($tags)>0){
                $sql="SELECT
                id,
                article,
                total_pair,
                category,
                orginal_article 
                FROM
                    articles 
                WHERE
                JSON_CONTAINS(
                tags,
                '$json')
                ";

                $data = Yii::app()->db->createCommand($sql)->queryAll();
               }
            
           
    
            }
             Generic::_setTrace($sql);
    
            $arrayDataProvider = new CArrayDataProvider($data, array(
                'id'=>'id',
                /* 'sort'=>array(
                    'attributes'=>array(
                        'username', 'email',
                    ),
                ), */
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));
        


            $this->render('tagsAdmin',array(
                'data'=>$arrayDataProvider,
             
            ));
        

       
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
        $percentCategories = array_filter($this->categories, function($category) {
            return $category['calculation_type'] == 'PERCENT';
        });

        $percentCategoryList = array_column($percentCategories, 'name');

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
            elseif($_REQUEST['autoArticle'] ==1 && $_REQUEST['hint']==''){
                $msg = "বক্সের উপর লেখ";
               }

            
            elseif ( !in_array(strtoupper($_REQUEST["category_stock"]), $percentCategoryList) ) {         
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
                ( in_array(strtoupper($_REQUEST["category_stock"]), $percentCategoryList))
            ) {
                $msg = "বডিরেট দিন";
            } else {
                $msg = "ok";
            }

            if ($msg == "ok") {

                $category = addslashes(
                    trim(strtoupper($_REQUEST["category_stock"]))
                );
                //insert
                $categoryDetails = array_filter($this->categories, function($categoryDetail) use ($category) {
                    return $categoryDetail['name'] == $category;
                });
                $categoryDetails = reset($categoryDetails);

                // print_r($categoryDetails);die;
                $article = addslashes(
                    trim(strtoupper($_REQUEST["stock_article__sexyCombo"]))
                );
                
                $pair = addslashes(trim(strtoupper($_REQUEST["article_pair"])));
                $orginal_article =  addslashes(trim(strtoupper($_REQUEST['hint'])));


                $percentage = isset($_REQUEST['percentage'])  ? $_REQUEST['percentage'] : 0 ;

                if($percentage > 0) {
                    $percentage = $percentage * 1/ 100;
                }
                else{
                    $percentage = $categoryDetails['profit'] *1 /100;
                }
                if (in_array(strtoupper($_REQUEST["category_stock"]), $percentCategoryList)) {


                    $body_rate = addslashes(
                        trim(strtoupper($_REQUEST["article_body_rate"]))
                    );

                    $actual_rate =
                        $body_rate - intval(ceil($body_rate * $percentage));

                    $total_taka = $actual_rate * $pair;

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
        
                $res = 0;
                if ($msg == "ok") {
                    $is_new_record = false;
                    $model = Articles::model()->findByAttributes([
                        "article" => $article,
                    ]);
                    $body_rate = intval($body_rate) * 1;
                    $sql2 = " Insert into last_added_items set article='$article', category='$category', total_pair=$pair, total_taka=$total_taka,actual_price='$actual_rate',body_rate='$body_rate',added_date=NOW(),last_added_pair=$pair,last_added_taka=$total_taka, orginal_article='$orginal_article' on duplicate key update  total_pair=(total_pair+$pair), total_taka=(total_taka+$total_taka),added_date=NOW(),last_added_pair=$pair,last_added_taka=$total_taka;";

                    if ($model) {
                        if($_REQUEST['autoArticle'] ==1){
                            die(json_encode(["status" => "Article exists/ বক্সের উপর লেখ", "info" => $_REQUEST]));
                        }
                        $model->body_rate = $body_rate;
                        $model->total_pair = $model->total_pair + $pair;
                        $model->total_taka = $model->total_taka + $total_taka;
                        $model->added_date = date('Y-m-d');
                        $model->last_added_pair = $pair;
                        $model->last_added_taka = $total_taka;
                        $model->increment = $actual_rate - $model->actual_price;
                        $model->orginal_article = $orginal_article;
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
                        $model->orginal_article = $orginal_article;
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
                    // show message for error without insert
                }
            }

            if (Yii::app()->request->isAjaxRequest) {
                die(json_encode(["status" => $msg, "info" => $_REQUEST]));
            }
        }

        $lastId = 0;
        if(isset($_REQUEST['cat']) ){

         $lastId = Yii::app()->db->createCommand('SELECT id FROM articles ORDER BY id DESC LIMIT 1')->queryScalar();
        }

            $this->render("add", [
                "msg" => $msg,
                'percentCategoryList'=>$percentCategoryList,
                'lastId'=>$lastId
            ]);
        }
    
}
