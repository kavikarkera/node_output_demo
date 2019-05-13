<?php

/**
 * @file
 * Contains \Drupal\node_output_demo\Controller\NodedemoController.
 */

namespace Drupal\node_output_demo\Controller;

use Drupal\Core\Access\AccessResult; 
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\Component\Serialization\Json;


/**
 * Provides json responses for the node_output_demo module.
 */
class NodedemoController extends ControllerBase
{
   /**
   * Returns a simple page.
   * 
   * @api_key
   * API key retrieved from the page url.
   * 
   * @nid
   * node id retrieved from the page url.
   * @return array
   * A simple json response.
   */
    public function nodecontent($api_key, $nid) 
    {
        if (is_numeric($nid)) {
            $node = \Drupal::entityTypeManager()->getStorage('node')->load($nid);
            if (!empty($node)) {
                $node_body_value = $node->get('body')->getValue();
                $output = Json::encode($node_body_value[0]);
            } else {
                $output = "Node does not exist";
            }
            
        } else {
            $output = "Please pass valid node id";
        }
        return array(
            '#markup' => $output
          );
        
    }

    /**
    * Checks access for this NodedemoController.
    *
    * @api_key 
    * API key retrieved from the page url.
    *
    * @nid
    * node id retrieved from the page url.
    * @return.
    * returns the object of AccessResult.
    */
    public function contentaccess($api_key, $nid) 
    {
        $api_val = \Drupal::config('node_output_demo.apikey')->get('siteapikey');
        if ($api_val === $api_key) {
            return AccessResult::allowed();
        }
        return AccessResult::forbidden();
    }
}
?>