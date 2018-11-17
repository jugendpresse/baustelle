<?php

/**
 * isset and not empty
 *
 * @param $var
 *
 * @return bool
 */
function isSNE ($var) {
    if (isset($var)) {
        if (!empty($var) or (is_string($var) and $var != '')) {
            return true;
        }
    }
    return false;
}

function getJsonFile ($name): array {
    global $base;
    return [
        $name => json_decode(file_get_contents($base . 'json/' . $name . '.json'), true)
    ];
}

function preparePhoneSettings ($new, &$settings) {
    foreach ($new as $tag => $data) {
        if (!isset($data['attributes']) or !isset($data['attributes']['perm'])) {
            $data['attributes']['perm'] = getenv('DEF_PERM_ATTR', '&');
        }
        $settings[$tag] = $data;
    }
}

function prepareActions ($new, $mac, &$settings) {
    global $twig;
    $actions = [];
    foreach ($new as $tag => $setting) {
        $value = '';
        if (isSNE($setting['action']) and isSNE($setting['state'])) {
            $setting['mac'] = $mac;
            try {
                $twig_template = $twig->createTemplate(getenv('ACTION_TRACKTOOL', 'http://phonestate.local') . getenv('ACTION_URL', '/api/{{ mac }}/{{ action }}/{{ state }}'));
                $value = $twig_template->render($setting);
            } catch (Throwable $e) {
                if (getenv('DEBUG', false)) {
                    var_dump ($e);
                }
            }
        }
        $actions[$tag] = compact('value');
    }
    preparePhoneSettings($actions, $settings);
}

function prepareIDX ($idx, $data, &$settings, $force = false, $twigVars = []) {
    global $twig;
    $idxs = [];
    $keywords = ['value', 'attributes', 'tag'];
    foreach ($data as $tag => $value) {
        $ident = $tag . '_IDX' . $idx;
        if (!isset($settings[$ident]) or $force) {
            foreach ($value as $key => &$kvalue) {
                if (!empty($twigVars)) {
                    try {
                        $kvalue_tpl = $twig->createTemplate($kvalue);
                        $kvalue = $kvalue_tpl->render($twigVars);
                    } catch (Throwable $e) {
                        if (getenv('DEBUG', false)) {
                            var_dump ($e);
                        }
                    }
                }
                if (!in_array($key, $keywords)) {
                    $value['attributes'][$key] = $kvalue;
                    unset($value[$key]);
                }
            }
            $idxs[$ident] = $value;
            $idxs[$ident]['tag'] = $tag;
            $idxs[$ident]['attributes']['idx'] = $idx;
        }
    }
    preparePhoneSettings($idxs, $settings);
}
