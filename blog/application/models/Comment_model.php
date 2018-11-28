<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment_model extends CI_Model
{

    //get input values
    public function input_values()
    {
        $data = array(
            'post_id' => $this->input->post('post_id', true),
            'user_id' => $this->input->post('user_id', true),
            'parent_id' => $this->input->post('parent_id', true),
            'comment' => $this->input->post('comment', true)
        );
        return $data;
    }

    //add comment
    public function add_comment()
    {
        $data = $this->comment_model->input_values();
        return $this->db->insert('comments', $data);
    }

    //get comment
    public function get_comment($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('comments');
        return $query->row();
    }

    //post comment count
    public function post_comment_count($post_id)
    {
        $this->db->join('users', 'comments.user_id = users.id');
        $this->db->join('posts', 'comments.post_id = posts.id');
        $this->db->where('post_id', $post_id);
        $query = $this->db->get('comments');
        return $query->num_rows();
    }

    //get comments
    public function get_comments($post_id, $limit)
    {
        $this->db->join('users', 'comments.user_id = users.id');
        $this->db->join('posts', 'comments.post_id = posts.id');
        $this->db->where('post_id', $post_id);
        $this->db->where('parent_id', 0);
        $this->db->select('comments.* , users.avatar as user_avatar, users.id as user_id, users.username as username');
        $this->db->limit($limit);
        $this->db->order_by('comments.id', 'DESC');
        $query = $this->db->get('comments');
        return $query->result();
    }

    //get all comments
    public function get_all_comments()
    {
        $this->db->join('users', 'comments.user_id = users.id');
        $this->db->join('posts', 'comments.post_id = posts.id');
        $this->db->select('comments.* , users.email as user_email, users.id as user_id,users.username as username, posts.title as post_title ');
        $this->db->order_by('comments.id', 'DESC');
        $query = $this->db->get('comments');
        return $query->result();
    }

    //get last comments
    public function get_last_comments($limit)
    {
        $this->db->join('users', 'comments.user_id = users.id');
        $this->db->join('posts', 'comments.post_id = posts.id');
        $this->db->select('comments.* , users.avatar as user_avatar, users.username as username, posts.title_slug as post_slug, ');
        $this->db->order_by('comments.id', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get('comments');
        return $query->result();
    }

    //get subcomments
    public function get_subcomments($comment_id)
    {
        $this->db->join('users', 'comments.user_id = users.id');
        $this->db->join('posts', 'comments.post_id = posts.id');
        $this->db->where('parent_id', $comment_id);
        $this->db->select('comments.* , users.avatar as user_avatar, users.id as user_id, users.username as username');
        $this->db->order_by('comments.id', 'DESC');
        $query = $this->db->get('comments');
        return $query->result();
    }

    //get post comment count
    public function get_post_comment_count($post_id)
    {
        $this->db->join('users', 'comments.user_id = users.id');
        $this->db->where('post_id', $post_id);
        $this->db->where('parent_id', 0);
        $this->db->select('comments.* , users.avatar as user_avatar');
        $query = $this->db->get('comments');
        return $query->num_rows();
    }

    //get comment count
    public function get_comment_count()
    {
        $query = $this->db->get('comments');
        return $query->num_rows();
    }

    //delete comment
    public function delete_comment($id)
    {
        $subcomments = $this->get_subcomments($id);

        if (!empty($subcomments)) {

            foreach ($subcomments as $comment) {

                $this->delete_subcomments($comment->id);

                $this->db->where('id', $comment->id);
                $this->db->delete('comments');
            }
        }

        $this->db->where('id', $id);
        return $this->db->delete('comments');
    }

    //delete sub comments
    public function delete_subcomments($id)
    {
        $subcomments = $this->get_subcomments($id);

        if (!empty($subcomments)) {
            foreach ($subcomments as $comment) {
                $this->db->where('id', $comment->id);
                $this->db->delete('comments');
            }
        }

    }

    //delete multi post
    public function delete_multi_comments($comment_ids)
    {
        if (!empty($comment_ids)) {
            foreach ($comment_ids as $id) {
                $subcomments = $this->get_subcomments($id);

                if (!empty($subcomments)) {
                    foreach ($subcomments as $comment) {
                        $this->delete_subcomments($comment->id);
                        $this->db->where('id', $comment->id);
                        $this->db->delete('comments');
                    }
                }

                $this->db->where('id', $id);
                $this->db->delete('comments');
            }
        }
    }


}