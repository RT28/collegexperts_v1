<?php

namespace common\models;

use Yii;
use backend\models\UniversityDepartments;

/**
 * This is the model class for table "university".
 *
 * @property integer $id
 * @property string $name
 * @property string $establishment_date
 * @property string $address
 * @property integer $city_id
 * @property integer $state_id
 * @property integer $country_id
 * @property integer $pincode
 * @property string $email
 * @property string $website
 * @property string $description
 * @property string $fax
 * @property string $phone_1
 * @property string $phone_2
 * @property string $contact_person
 * @property string $contact_person_designation
 * @property string $contact_mobile
 * @property string $contact_email
 * @property string $location
 * @property integer $institution_type
 * @property integer $establishment
 * @property integer $no_of_students
 * @property integer $no_of_internation_students
 * @property integer $no_faculties
 * @property integer $no_of_international_faculty
 * @property integer $cost_of_living
 * @property boolean $accomodation_available
 * @property integer $hostel_strength
 * @property integer $institution_ranking
 * @property string $ranking_sources
 * @property string $video
 * @property string $virtual_tour
 * @property integer $avg_rating
 * @property boolean $standard_tests_required
 * @property string $standard_test_list
 * @property string $achievements
 * @property string $comments
 * @property integer $status
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 * @property integer $reviewed_by
 * @property string $reviewed_at
 *
 * @property City $city
 * @property Country $country
 * @property State $state
 * @property UniversityAdmission[] $universityAdmissions
 * @property UniversityCourseList[] $universityCourseLists
 * @property UniversityDepartments[] $universityDepartments
 */
class University extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'university';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'city_id', 'state_id', 'country_id', 'pincode', 'email', 'website', 'description', 'phone_1', 'contact_person', 'contact_person_designation', 'contact_mobile', 'contact_email', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'required'],
            [['establishment_date', 'created_at', 'updated_at', 'reviewed_at'], 'safe'],
            [['city_id', 'state_id', 'country_id', 'pincode', 'institution_type', 'establishment', 'no_of_students', 'no_of_internation_students', 'no_faculties', 'no_of_international_faculty', 'cost_of_living', 'hostel_strength', 'institution_ranking', 'avg_rating', 'status', 'created_by', 'updated_by', 'reviewed_by'], 'integer'],
            [['description', 'ranking_sources', 'achievements', 'comments'], 'string'],
            [['accomodation_available', 'standard_tests_required'], 'boolean'],
            [['name', 'address', 'email', 'website', 'contact_person', 'contact_email'], 'string', 'max' => 255],
            [['fax', 'phone_1', 'phone_2'], 'string', 'max' => 20],
            [['contact_person_designation'], 'string', 'max' => 50],
            [['contact_mobile'], 'string', 'max' => 15],
            [['video', 'virtual_tour', 'standard_test_list'], 'string', 'max' => 500],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => State::className(), 'targetAttribute' => ['state_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'establishment_date' => 'Establishment Date',
            'address' => 'Address',
            'city_id' => 'City',
            'state_id' => 'State',
            'country_id' => 'Country',
            'pincode' => 'Pincode',
            'email' => 'Email',
            'website' => 'Website',
            'description' => 'Description',
            'fax' => 'Fax',
            'phone_1' => 'Phone 1',
            'phone_2' => 'Phone 2',
            'contact_person' => 'Contact Person',
            'contact_person_designation' => 'Contact Person Designation',
            'contact_mobile' => 'Contact Mobile',
            'contact_email' => 'Contact Email',
            'location' => 'Location',
            'institution_type' => 'Institution Type',
            'establishment' => 'Establishment',
            'no_of_students' => 'No Of Students',
            'no_of_internation_students' => 'No Of Internation Students',
            'no_faculties' => 'No Faculties',
            'no_of_international_faculty' => 'No Of International Faculty',
            'cost_of_living' => 'Cost Of Living',
            'accomodation_available' => 'Accomodation Available',
            'hostel_strength' => 'Hostel Strength',
            'institution_ranking' => 'Institution Ranking',
            'ranking_sources' => 'Ranking Sources',
            'video' => 'Video',
            'virtual_tour' => 'Virtual Tour',
            'avg_rating' => 'Avg Rating',
            'standard_tests_required' => 'Standard Tests Required',
            'standard_test_list' => 'Standard Test List',
            'achievements' => 'Achievements',
            'comments' => 'Comments',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'reviewed_by' => 'Reviewed By',
            'reviewed_at' => 'Reviewed At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(State::className(), ['id' => 'state_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUniversityAdmissions()
    {
        return $this->hasMany(UniversityAdmission::className(), ['university_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUniversityCourseLists()
    {
        return $this->hasMany(UniversityCourseList::className(), ['university_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUniversityDepartments()
    {
        return $this->hasMany(UniversityDepartments::className(), ['university_id' => 'id']);
    }

}
