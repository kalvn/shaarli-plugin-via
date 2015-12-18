<?php
/**
 * Hook render_linklist.
 *
 * Template placeholders:
 *   - action_plugin: next to 'private only' button.
 *   - plugin_start_zone: page start
 *   - plugin_end_zone: page end
 *   - link_plugin: icons below each links.
 *
 * Data:
 *   - _LOGGEDIN_: true/false
 *
 * @param array $data data passed to plugin
 *
 * @return array altered $data.
 */
function hook_via_render_linklist($data)
{
	foreach ($data['links'] as &$value) {
		$originalUrl = isset($value['original_url']) ? $value['original_url'] : '';
		$originalLabel = isset($value['original_label']) ? $value['original_label'] : '';
		$html = '<br><span class="via">Via ';
		if(!empty($originalLabel) && !empty($originalUrl)){
			$html .= '<a href="' . $originalUrl. '">' . $originalLabel . '</a>';
		} else if(!empty($originalLabel)){
			$html .= $originalLabel;
		} else if(!empty($originalUrl)){
			$html .= '<a href="' . $originalUrl. '">' . $originalUrl . '</a>';
		} else{
			return $data;
		}
		
		$html .= '</span>';
		$value['description'] = $value['description'] . $html;
	}

    return $data;
}

/**
 * Hook render_editlink.
 *
 * Template placeholders:
 *   - field_plugin: add link fields after tags.
 *
 * @param array $data data passed to plugin
 *
 * @return array altered $data.
 */
function hook_via_render_editlink($data)
{
    // Load HTML into a string
    $html = file_get_contents(PluginManager::$PLUGINS_PATH .'/via/fields.html');

    // replace value in HTML if it exists in $data
	$originalLabel = isset($data['link']['original_label']) ? $data['link']['original_label'] : '';
	$originalUrl = isset($data['link']['original_url']) ? $data['link']['original_url'] : '';
	
	$html = sprintf($html, $originalLabel, $originalUrl);

    // field_plugin
    $data['edit_link_plugin'][] = $html;

    return $data;
}

/*
 * DATA SAVING HOOK.
 */

/**
 * Hook savelink.
 *
 * Triggered when a link is save (new or edit).
 * All new links now contain a 'stuff' value.
 *
 * @param array $data contains the new link data.
 *
 * @return array altered $data.
 */
function hook_via_save_link($data)
{

    // Save stuff added in editlink field
    if (!empty($_POST['lf_original_label'])) {
        $data['original_label'] = escape($_POST['lf_original_label']);
    }
	if (!empty($_POST['lf_original_url'])) {
        $data['original_url'] = escape($_POST['lf_original_url']);
    }

    return $data;
}
