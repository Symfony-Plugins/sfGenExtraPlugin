<?php

 /*
 * Base class to add number range filters
 *
 */
abstract class genExtraFormFilterDoctrine extends sfFormFilterDoctrine
{
  public function setup()
  {
  }


  protected function addNumberQuery(Doctrine_Query $query, $field, $values)
  {
    $fieldName = $this->getFieldName($field);
    
    if (!isset($values['from'])) {

	    if (is_array($values) && isset($values['is_empty']) && $values['is_empty'])
	    {
	      $query->addWhere('r.' . $fieldName . ' IS NULL');
	    }
	    else if (is_array($values) && isset($values['text']) && '' != $values['text'])
	    {
	      $query->addWhere('r.' . $fieldName . ' = ?', $values['text']);
	    }
	    
    }
    else
    {      
	    if (isset($values['is_empty']) && $values['is_empty'])
	    {
	      $query->addWhere('r.' . $fieldName . ' IS NULL');
	    }
	    else
	    {
	      $criterion = null;
	      if (!is_null($values['from']) && !is_null($values['to']))
	      {
	        $query->andWhere('r.' . $fieldName . ' >= ?', $values['from']);
	        $query->andWhere('r.' . $fieldName . ' <= ?', $values['to']);
	      }
	      else if (!is_null($values['from']))
	      {
	        $query->andWhere('r.' . $fieldName . ' >= ?', $values['from']);
	      }
	      else if (!is_null($values['to']))
	      {
	        $query->andWhere('r.' . $fieldName . ' <= ?', $values['to']);
	      }
      }
    }
  }
  
}