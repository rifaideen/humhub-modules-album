<?php

/**
 * This is the model class for table "album_album".
 *
 * The followings are the available columns in table 'album_album':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * The followings are the available model relations:
 * @property AlbumImage[] $images
 */
class Album extends HActiveRecordContent
{
	
        /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'album_album';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
			['name', 'required'],
			['name', 'length', 'max'=>255],
                        ['description', 'safe'],
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			['id, name, description, created_at, updated_at, created_by, updated_by', 'safe', 'on'=>'search'],
		];
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return [
			//'images' => array(self::HAS_MANY, 'AlbumImage', 'album_id'),
                        'cover' => [self::HAS_ONE,'PublicFile','object_id','condition'=>"cover.object_model ='Album'",'select'=>'cover.id,cover.guid,cover.file_name']
		];
	}
        
        /**
         * Get Associated Album Images.
         * @return array AlbumImage
         */
        public function getImages()
        {
            return AlbumImage::model()->with('image')->findAllByAttributes(['album_id'=>$this->id]);
        }

        /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'created_by' => 'Created By',
			'updated_by' => 'Updated By',
		];
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('updated_by',$this->updated_by);

		return new CActiveDataProvider($this, [
			'criteria'=>$criteria,
		]);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Album the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        /**
         * After Saving album fire the album created activity
         */
        public function afterSave()
        {
            parent::afterSave();
            
            if ($this->isNewRecord) {
                $activity = Activity::CreateForContent($this);
                $activity->type = "AlbumCreated";
                $activity->module = "album";
                $activity->save();
                $activity->fire();
            }
            
            return true;
        }
        
        /**
         * Cleanup AlbumImage
         */
        public function beforeDelete() 
        {
            $cover = $this->cover;
            if ($cover != null) {
                $cover->delete();
            }
            foreach ($this->getImages() as $image) {
                $image->delete();
            }
            
            return parent::beforeDelete();
        }
        
        /**
         * Returns the Wall Output
         */
        public function getWallOut()
        {
            return Yii::app()->getController()->widget('application.modules.album.widgets.AlbumWidget', ['album' => $this], true);
        }
        
        /**
         * Returns a title/text which identifies this IContent.
         *
         * e.g. Task: foo bar 123...
         *
         * @return String
         */
        public function getContentTitle()
        {
            return "\"" . Helpers::truncateText($this->name, 25) . "\"";
        }
}
