<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 cc=80; */

/**
 * @package     omeka
 * @subpackage  solr-search
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */


class SolrSearchFacetTable extends Omeka_Db_Table
{


    /**
     * Get all facets grouped by element set id.
     *
     * @return array $facets The ElementSet-grouped facets.
     */
    public function groupByElementSet()
    {

        $facets = $this->findAll();
        $groups = array();

        foreach ($facets as $facet) {

            // Get element set name.
            $setName = !is_null($facet->element_set_id) ?
                $facet->getElementSet()->name :
                __('Omeka Categories');

            // If the key exists, push.
            if (array_key_exists($setName, $groups)) {
                array_push($groups[$setName], $facet);
            } else {
                // If not, create and push.
                $groups[$setName] = array($facet);
            }

        }

        return $groups;

    }


}
