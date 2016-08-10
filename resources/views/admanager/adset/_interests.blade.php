<!--<select name='target_id' class="form-control">
   
   @if(!isset($results))
   
        <option value='{!! $adset->target_id !!}'>{!! $adset->target_name !!}</option>
    
  
   @else
   
        <option value=''></option>
    
        @foreach($results As $result)

          <?php $data = $result->getData(); ?>

            @if($search_target_id == $data['id'])
                <option value={!! $data['id'] !!} selected="selected">{!! $data['name'] !!}</option>
            @else 
                <option value={!! $data['id'] !!}>{!! $data['name'] !!}</option>
            @endif
           
        @endforeach
    
   @endif
    

</select>-->

 <!--  -------------------------------------------------- -->
  @if(isset($results))
  
  <ul>
    @foreach($results As $result)
    
        <?php $data = $result->getData(); ?>
    
        @if(isset($groups_selected) && in_array($data['id'], $groups_selected))
                <li><input type="checkbox" class="chk_interests" name="interests[]" value={!! $data['id'] !!} checked>&nbsp;{!! $data['name'] !!}</li>
            @else 
                <li><input type="checkbox" class="chk_interests" name="interests[]" value={!! $data['id'] !!}>&nbsp;{!! $data['name'] !!} </li>
        @endif
        
    @endforeach    
  </ul>      
 @endif      

 @if(isset($results))
 <?php
 
  if(sizeof($results) == 0){
    //var_dump(json_decode(Session::get('selected_target_groups')));
    \Allison\models\FbAd\AdTargetGroup::render_target_group_selections(Session::get('selected_target_groups'));
  }
 ?> 
@endif 
 
 
<!--  -------------------------------------------------- -->


{!! Form::hidden('selected_target_name', null, ['id'=>'selected_target_name', 'class'=>'form-control']) !!}

@if(isset($target_groups))
    {!! Form::hidden('selected_target_groups', $target_groups, ['id'=>'selected_target_groups', 'class'=>'form-control']) !!}
@else
    {!! Form::hidden('selected_target_groups', null, ['id'=>'selected_target_groups', 'class'=>'form-control']) !!}
@endif 