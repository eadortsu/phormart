<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Navigation_model extends CI_Model
{
    //input values
    public function input_values()
    {
        $data = array(
            'lang_id' => $this->input->post('lang_id', true),
            'title' => $this->input->post('title', true),
            'link' => $this->input->post('link', true),
            'page_order' => $this->input->post('page_order', true),
            'page_active' => $this->input->post('page_active', true),
            'parent_id' => $this->input->post('parent_id', true),
            'location' => "header"
        );
        return $data;
    }

    //add link
    public function add_link()
    {
        $data = $this->input_values();

        //slug for title
        if (empty($data["slug"])) {
            $data["slug"] = str_slug($data["title"]);
        }

        if (empty($data['link'])) {
            $data['link'] = "#";
        }

        return $this->db->insert('pages', $data);
    }

    //update link
    public function update_link($id)
    {
        $data = $this->input_values();
        //slug for title
        if (empty($data["slug"])) {
            $data["slug"] = str_slug($data["title"]);
        }

        $this->db->where('id', $id);
        return $this->db->update('pages', $data);
    }

    //get parent link
    public function get_parent_link($parent_id, $type)
    {
        if ($type == "page" || $type == "link") {
            $this->db->where('id', $parent_id);
            $query = $this->db->get('pages');
            return $query->row();
        }
        if ($type == "category") {
            $this->db->where('id', $parent_id);
            $query = $this->db->get('categories');
            return $query->row();
        }
    }

    //get all parent links
    public function get_all_menu_links()
    {
        $menu = array();
        $pages = $this->page_model->get_all_pages();
        if (!empty($pages)) {
            foreach ($pages as $page) {
                $page_type = "page";
                if (!empty($page->link)) {
                    $page_type = "link";
                }
                $item = array(
                    'order' => $page->page_order,
                    'id' => $page->id,
                    'lang_id' => $page->lang_id,
                    'parent_id' => $page->parent_id,
                    'title' => $page->title,
                    'slug' => $page->slug,
                    'link' => base_url() . $page->slug,
                    'type' => $page_type,
                    'location' => $page->location,
                    'visibility' => $page->page_active,
                );

                if ($page_type == "link") {
                    $item["link"] = $page->link;
                }
                if ($page->slug == "index") {
                    $item["link"] = base_url();
                }

                array_push($menu, $item);
            }
        }

        $categories = $this->category_model->get_all_categories();
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $item = array(
                    'order' => $category->category_order,
                    'id' => $category->id,
                    'lang_id' => $category->lang_id,
                    'parent_id' => $category->parent_id,
                    'title' => $category->name,
                    'slug' => $category->slug,
                    'link' => base_url() . "category/" . $category->slug,
                    'type' => "category",
                    'location' => "header",
                    'visibility' => $category->show_on_menu,
                );
                array_push($menu, $item);
            }
        }
        sort($menu);
        return $menu;
    }

    //get parent links
    public function get_menu_links()
    {
        $menu = array();
        $pages = $this->page_model->get_pages();
        if (!empty($pages)) {
            foreach ($pages as $page) {
                $page_type = "page";
                if (!empty($page->link)) {
                    $page_type = "link";
                }
                $item = array(
                    'order' => $page->page_order,
                    'id' => $page->id,
                    'lang_id' => $page->lang_id,
                    'parent_id' => $page->parent_id,
                    'title' => $page->title,
                    'slug' => $page->slug,
                    'link' => lang_base_url() . $page->slug,
                    'type' => $page_type,
                    'location' => $page->location,
                    'visibility' => $page->page_active,
                );

                if ($page_type == "link") {
                    $item["link"] = $page->link;
                }
                if ($page->slug == "index") {
                    $item["link"] = lang_base_url();
                }

                array_push($menu, $item);
            }
        }

        $categories = $this->category_model->get_categories();
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $item = array(
                    'order' => $category->category_order,
                    'id' => $category->id,
                    'lang_id' => $category->lang_id,
                    'parent_id' => $category->parent_id,
                    'title' => $category->name,
                    'slug' => $category->slug,
                    'link' => lang_base_url() . "category/" . $category->slug,
                    'type' => "category",
                    'location' => "header",
                    'visibility' => $category->show_on_menu,
                );
                array_push($menu, $item);
            }
        }

        sort($menu);
        return $menu;
    }

    //get parent links by lang
    public function get_menu_links_by_lang($lang_id)
    {
        $menu = array();
        $pages = $this->page_model->get_pages_by_lang($lang_id);
        if (!empty($pages)) {
            foreach ($pages as $page) {
                $page_type = "page";
                if (!empty($page->link)) {
                    $page_type = "link";
                }
                $item = array(
                    'order' => $page->page_order,
                    'id' => $page->id,
                    'lang_id' => $page->lang_id,
                    'parent_id' => $page->parent_id,
                    'title' => $page->title,
                    'slug' => $page->slug,
                    'link' => base_url() . $page->slug,
                    'type' => $page_type,
                    'location' => $page->location,
                    'visibility' => $page->page_active,
                );

                if ($page_type == "link") {
                    $item["link"] = $page->link;
                }
                if ($page->slug == "index") {
                    $item["link"] = base_url();
                }

                array_push($menu, $item);
            }
        }

        $categories = $this->category_model->get_categories_by_lang($lang_id);
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $item = array(
                    'order' => $category->category_order,
                    'id' => $category->id,
                    'lang_id' => $category->lang_id,
                    'parent_id' => $category->parent_id,
                    'title' => $category->name,
                    'slug' => $category->slug,
                    'link' => base_url() . "category/" . $category->slug,
                    'type' => "category",
                    'location' => "header",
                    'visibility' => $category->show_on_menu,
                );
                array_push($menu, $item);
            }
        }

        sort($menu);
        return $menu;
    }

    //get sub links
    public function get_sub_links($id, $type)
    {
        $menu = array();

        if ($type == "page" || $type == "link") {
            $pages = $this->page_model->get_subpages($id);
            if (!empty($pages)) {
                foreach ($pages as $page) {
                    $page_type = "page";
                    if (!empty($page->link)) {
                        $page_type = "link";
                    }
                    $item = array(
                        'order' => $page->page_order,
                        'id' => $page->id,
                        'parent_id' => $page->parent_id,
                        'title' => $page->title,
                        'slug' => $page->slug,
                        'link' => lang_base_url() . $page->slug,
                        'type' => $page_type,
                        'location' => $page->location,
                        'visibility' => $page->page_active,
                    );

                    if ($page_type == "link") {
                        $item["link"] = $page->link;
                    }
                    if ($page->slug == "index") {
                        $item["link"] = lang_base_url();
                    }

                    array_push($menu, $item);
                }
            }
        }

        if ($type == "category") {
            $categories = $this->category_model->get_subcategories_by_parent_id($id);
            if (!empty($categories)) {
                foreach ($categories as $category) {
                    $item = array(
                        'order' => $category->category_order,
                        'id' => $category->id,
                        'parent_id' => $category->parent_id,
                        'title' => $category->name,
                        'slug' => $category->slug,
                        'link' => lang_base_url() . "category/" . $category->slug,
                        'type' => "category",
                        'location' => "header",
                        'visibility' => $category->show_on_menu,
                    );
                    array_push($menu, $item);
                }
            }
        }

        sort($menu);
        return $menu;
    }

    //update menu limit
    public function update_menu_limit()
    {
        $data = array(
            'menu_limit' => $this->input->post('menu_limit', true),
        );

        $this->db->where('id', 1);
        return $this->db->update('general_settings', $data);
    }
}