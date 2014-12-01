<?php

/**
 * This is the model class for table "album_image".
 *
 * The followings are the available columns in table 'album_image':
 * @property integer $id
 * @property integer $album_id
 * @property string $name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property Album $album
 */
class AlbumImage extends HActiveRecord
{
        public $_image;
        
        /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'album_image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
                    ['album_id, name, description', 'required'],
                    ['_image', 'required','on'=>'insert','message'=>'Image cannot be blank.'],
                    ['album_id', 'numerical', 'integerOnly'=>true],
                    ['description', 'length', 'max'=>255],
                    ['name', 'length', 'max'=>100],
                    ['created_at, updated_at', 'safe'],
                    // The following rule is used by search().
                    // @todo Please remove those attributes that should not be searched.
                    ['id, album_id, name, description, created_at, updated_at', 'safe', 'on'=>'search'],
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
                    'album' => [self::BELONGS_TO, 'Album', 'album_id'],
                    'image' => [self::HAS_ONE,'PublicFile','object_id','condition'=>"image.object_model ='AlbumImage'",'select'=>'image.id,image.guid,image.file_name']
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
                    'id' => 'ID',
                    'album_id' => 'Album',
                    'name' => 'Name',
                    'description' => 'Description',
                    'created_at' => 'Created At',
                    'updated_at' => 'Updated At',
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
		$criteria->compare('album_id',$this->album_id);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, [
                    'criteria'=>$criteria,
		]);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AlbumImage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        /**
         * Cleanup image.
         */
        public function afterDelete() 
        {
            $this->image->delete();
            parent::afterDelete();
        }
}
