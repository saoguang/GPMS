<?php
//by xiaoming
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Models\SectionInfo;
use App\Http\Models\CollegeInfo;
use Illuminate\Http\Request;

class ManageSectionInfoController extends Controller
{
    public function sectionInfo()//教研室信息管理
    {
        $sectionInfos=SectionInfo::paginate(10);

        return view('admin.manageInfo.section.section',[
            'sectionInfos' => $sectionInfos,
        ]);
    }

    public function sectionInfoUpdate(Request $request,$id)//修改信息
    {
        $sectionInfo=SectionInfo::find($id);//修改，所以找到对应数据
        $collegeInfos=CollegeInfo::get();//获取数据库中其他表的数据

        if ($request->isMethod('post')) {

            //Validator类验证
            $validator = \Validator::make($request->input(), [
                'SectionInfo.section_name' => 'required|min:1|max:10',
                'SectionInfo.college_info_id' => 'required|integer',
            ], [
                'required' => ':attribute 必须填写！',
                'min' => ':attribute 长度过短！',
                'max' => ':attribute 长度过长！',
                'integer' => ':attribute 必须为整数',
            ], [
                'SectionInfo.section_name' => '教研室名称',
                'SectionInfo.college_info_id' => '所属学院',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->input('SectionInfo');//获取输入的数据

            $sectionInfo->section_name = $data['section_name'];//赋值
            $sectionInfo->college_info_id = $data['college_info_id'];

            if ($sectionInfo->save() ) {//保持成功与失败
                return redirect('/admin/manageInfo/section')->with('success',  '修改成功!');
            } else {
                return redirect()->back()->with('success', '修改失败!');
            }
        }

        return view('admin.manageInfo.section.update', [//视图
            'sectionInfo' => $sectionInfo,
            'collegeInfos'=>$collegeInfos
        ]);

    }

    public function sectionInfoCreate(Request $request)// 新增信息          //    错误信息提示有待于完成
    {
        $sectionInfo=new SectionInfo();
        $collegeInfos=CollegeInfo::get();

        if ($request->isMethod('post')) {

            //Validator类验证
            $validator = \Validator::make($request->input(), [
                'SectionInfo.section_name' => 'required|min:1|max:10',
                'SectionInfo.college_info_id' => 'required|integer',
            ], [
                'required' => ':attribute 必须填写！',
                'min' => ':attribute 长度过短！',
                'max' => ':attribute 长度过长！',
                'integer' => ':attribute 必须为整数',
            ], [
                'SectionInfo.section_name' => '教研室名称',
                'SectionInfo.college_info_id' => '所属学院',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->input('SectionInfo');

            if (SectionInfo::create($data) ) {
                return redirect('/admin/manageInfo/section')->with('success', '添加成功!');
            } else {
                return redirect()->back();
            }
        }

        return view('admin.manageInfo.section.create', [
            'sectionInfo' => $sectionInfo,
            'collegeInfos'=>$collegeInfos
        ]);

    }

    public function sectionInfoDelete($id)//删除信息
    {
        $sectionInfo=SectionInfo::find($id);

        if($sectionInfo->delete()){
            return redirect('/admin/manageInfo/section')->with('success', '删除成功!-'.$id);
        }else {
            return redirect('/admin/manageInfo/section')->with('error', '删除成功!-'.$id);
        }
    }

}